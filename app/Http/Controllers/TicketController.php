<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\EventRsvp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        // QR data
        $qrData = $payment ? $payment->reference : 'FREE-TICKET-' . $ticket->id;

        // Generate QR code as SVG (doesn't require imagick or GD)
        $qrcodeSvg = QrCode::format('svg')
                ->size(200)
                ->generate($qrData);
        
        // Convert SVG to data URI for embedding in PDF
        $qrcodeDataUri = 'data:image/svg+xml;base64,' . base64_encode($qrcodeSvg);

        // Generate PDF
        $pdf = Pdf::loadView('tickets.pdf', [
            'ticket' => $ticket,
            'payment' => $payment,
            'qrcode' => $qrcodeDataUri
        ]);

        return $pdf->download('EventTicket-' . $ticket->id . '.pdf');
    }
}
