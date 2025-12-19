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
        //Get all events the user has joined
        $tickets = EventRsvp::with('event')->where('user_id', Auth::id())->latest()->get();
        //Attach payment info manually
        foreach ($tickets as $ticket) {
            if ($ticket->event->price > 0) {
                $ticket->payment = Payment::where('user_id', Auth::id())
                    ->where('event_id', $ticket->event->id)
                    ->where('status', 'successful')
                    ->first();
            }
        }
        return view('tickets.index', compact('tickets'));
    }
}
