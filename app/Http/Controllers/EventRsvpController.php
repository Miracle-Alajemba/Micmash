<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRsvp;
use Illuminate\Http\Request; // ✅ Required for validation
use Illuminate\Support\Facades\Auth;

class EventRsvpController extends Controller
{
    // 1. JOIN or UPDATE existing RSVP
    public function store(Request $request, Event $event)
    {
        // Validate the input (0 to 5 guests)
        $request->validate([
            'guests_count' => 'required|integer|min:0|max:5'
        ]);

        // Logic: If user is already in list, update 'guests_count'.
        // If not in list, create a new row.
        EventRsvp::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'event_id' => $event->id
            ],
            [
                'guests_count' => $request->guests_count
            ]
        );

        return back()->with('success', 'RSVP confirmed! You are on the list.');
    }

    // 2. LEAVE the event
    public function destroy(Event $event)
    {
        EventRsvp::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->delete();

        return back()->with('success', 'You have left the event.');
    }
}
