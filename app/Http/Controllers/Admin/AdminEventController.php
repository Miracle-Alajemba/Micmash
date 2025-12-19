<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Payment;
use App\Models\EventRsvp;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    // List all events (pending first)
    public function index()
    {
        // Keep ONLY this part.
        // Changed 'simplepaginate' to 'paginate' for standard page numbers.
        $events = Event::with('user', 'category')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->latest()
            ->simplepaginate(10);

        return view('admin.events.index', compact('events'));
    }

    // Approve logic
    public function approve(Event $event)
    {
        $event->update(['status' => 'approved']);
        return back()->with('success', 'Event approved.');
    }

    // Reject logic
    public function reject(Event $event)
    {
        $event->update(['status' => 'rejected']);
        return back()->with('success', 'Event rejected.');
    }
    public function attendees(Event $event)
    {
        // Get all people who RSVP'd
        $attendees = EventRsvp::with('user')
            ->where('event_id', $event->id)
            ->get();

        // Attach payment info
        foreach ($attendees as $attendee) {
            if ($event->price > 0) {
                $attendee->payment = Payment::where('user_id', $attendee->user_id)
                    ->where('event_id', $event->id)
                    ->first();
            }
        }

        return view('admin.events.attendees', compact('event', 'attendees'));
    }
}
