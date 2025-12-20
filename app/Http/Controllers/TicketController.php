<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\EventRsvp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Display a listing of the user's tickets.
    public function index()
    {
        // 1. Get all events the user joined
        $tickets = EventRsvp::with('event')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // 2. Manually attach payment info
        foreach ($tickets as $ticket) {
            // Find the payment record based on User + Event
            // We removed the 'price > 0' check and 'status' check to be safe
            $payment = Payment::where('user_id', Auth::id())
                ->where('event_id', $ticket->event_id)
                ->latest() // Get the newest one
                ->first();

            // Attach it to the ticket object so the View can read it
            $ticket->setRelation('payment', $payment);
        }

        return view('tickets.index', compact('tickets'));
    }
}
