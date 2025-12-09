<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\EventSpeaker;

class EventSpeakerController extends Controller
{
    // Show form to add a speaker
    public function create(Event $event)
    {
        // Security check
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        return view('events.speakers.create', compact('event'));
    }

    // Store the speaker
    public function store(Request $request, Event $event)
    {
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);
        $data = $request->only(['name', 'role']);
        $data['event_id'] = $event->id;

        if ($request->hasFile('image')) {
            $filename = time() . '_speaker_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('speakers', $filename, 'public');

            $data['image'] = $filename;
        }

        EventSpeaker::create($data);

        return redirect()->route('events.show', $event)->with('success', 'Speaker added successfully.');
    }

    // Delete a speaker
    public function destroy(EventSpeaker $speaker)
    {
        $event = $speaker->event;

        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        if ($speaker->image) {
            Storage::disk('public')->delete('speakers/' . $speaker->image);
        }

        $speaker->delete();

        return back()->with('success', 'Speaker removed.');
    }
    // Show the Edit Form
    public function edit(EventSpeaker $speaker)
    {
        $event = $speaker->event;

        // Security Check: Allow Creator OR Admin
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('events.speakers.edit', compact('speaker', 'event'));
    }

    // Update the Speaker
    public function update(Request $request, EventSpeaker $speaker)
    {
        $event = $speaker->event;

        // Security Check: Allow Creator OR Admin
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name', 'role']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($speaker->image) {
                Storage::disk('public')->delete('speakers/' . $speaker->image);
            }


            // Store new image
            $filename = time() . '_speaker_' . $request->file('image')->getClientOriginalName();


            $request->file('image')->storeAs('speakers', $filename, 'public');



            $data['image'] = $filename;
        }

        $speaker->update($data);

        return redirect()->route('events.show', $event)->with('success', 'Speaker updated successfully.');
    }
}
