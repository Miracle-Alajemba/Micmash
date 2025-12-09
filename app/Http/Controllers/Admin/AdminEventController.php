<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
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
}
