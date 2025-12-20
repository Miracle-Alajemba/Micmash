<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRsvp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // ✅ Use Laravel's HTTP Client
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class PaymentController extends Controller
{
    // 1. Initialize Payment (Send user to Paystack)
    public function initialize(Request $request, Event $event)
    {
        $request->validate([
            'guests_count' => 'required|integer|min:0|max:5'
        ]);

        $user = Auth::user();
        $total_people = 1 + $request->guests_count;
        $amountKobo = ($event->price * $total_people) * 100; // Amount in Kobo

        // Prepare Data for Paystack API
        $paymentData = [
            'email' => $user->email,
            'amount' => $amountKobo,
            'reference' => 'TXN_' . uniqid() . '_' . time(), // Generate unique ref
            'callback_url' => route('payment.callback'),
            'metadata' => [
                'event_id' => $event->id,
                'guests_count' => $request->guests_count,
                'user_id' => $user->id
            ]
        ];

        try {
            // Send Request to Paystack API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type'  => 'application/json',
            ])->post('https://api.paystack.co/transaction/initialize', $paymentData);

            $result = $response->json();

            // Check if Paystack accepted it
            if ($response->successful() && $result['status']) {
                // Redirect user to the Paystack Payment Page
                return redirect($result['data']['authorization_url']);
            } else {
                // Log error for debugging
                Log::error('Paystack Error: ' . $response->body());
                return back()->with('error', 'Payment initialization failed: ' . ($result['message'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Payment Exception: ' . $e->getMessage());
            return back()->with('error', 'Network error connecting to Paystack.');
        }
    }

    // 2. Callback (User comes back from Paystack)
    // 2. Callback (User comes back from Paystack)
    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('events.index')->with('error', 'No payment reference found.');
        }

        try {
            // Verify with Paystack
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type'  => 'application/json',
            ])->get("https://api.paystack.co/transaction/verify/{$reference}");

            $result = $response->json();

            if ($response->successful() && $result['status'] && $result['data']['status'] === 'success') {

                $metadata = $result['data']['metadata'];
                $eventId = $metadata['event_id'];
                $guestsCount = $metadata['guests_count'];
                $userId = $metadata['user_id']; // or use Auth::id()

                // ✅ FIX: Save the Payment Record!
                Payment::create([
                    'user_id'   => $userId,
                    'event_id'  => $eventId,
                    'reference' => $result['data']['reference'],
                    'amount'    => $result['data']['amount'] / 100, // Convert Kobo to Naira
                    'status'    => 'success'
                ]);

                // Create the RSVP
                EventRsvp::updateOrCreate(
                    ['user_id' => $userId, 'event_id' => $eventId],
                    ['guests_count' => $guestsCount]
                );

                return redirect()->route('events.show', $eventId)->with('success', 'Payment successful! You are going.');
            }

            return redirect()->route('events.index')->with('error', 'Payment verification failed.');
        } catch (\Exception $e) {
            Log::error('Verification Exception: ' . $e->getMessage());
            return redirect()->route('events.index')->with('error', 'Could not verify payment.');
        }
    }
}
