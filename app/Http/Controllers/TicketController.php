<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\EventRsvp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Display a listing of the user's tickets.
    public function index()
    {
        $tickets = EventRsvp::with('event')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        foreach ($tickets as $ticket) {
            $payment = Payment::where('user_id', Auth::id())
                ->where('event_id', $ticket->event_id)
                ->latest()
                ->first();

            $ticket->setRelation('payment', $payment);
        }

        return view('tickets.index', compact('tickets'));
    }


    // Download Ticket as PDF
    public function download($id)
    {
        $ticket = EventRsvp::with('event')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $payment = Payment::where('user_id', Auth::id())
            ->where('event_id', $ticket->event_id)
            ->first();

        $qrData = $payment ? $payment->reference : 'FREE-TICKET-' . $ticket->id;

        // ← Replace this part
        $qrcode = base64_encode(
            QrCode::format('png')
                ->size(200)
                ->backend('gd') // force GD backend
                ->generate($qrData)
        );

        $pdf = Pdf::loadView('tickets.pdf', [
            'ticket' => $ticket,
            'payment' => $payment,
            'qrcode' => $qrcode
        ]);

        return $pdf->download('EventTicket-' . $ticket->id . '.pdf');
    }
}
