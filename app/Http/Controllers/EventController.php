<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\File;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\EventSpeaker;
use phpDocumentor\Reflection\Types\Nullable;

class EventController extends Controller
{
    use AuthorizesRequests; // ✅ Allows use of $this->authorize()

    // Show Homepage (Approved events only)
    public function index(Request $request)
    {
        $query = Event::with('user', 'category')->withCount('rsvps')->where('status', 'approved');

        // Search logic
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $events = $query->latest()->simplepaginate(9);

        $categories = EventCategory::all(); // For the filter dropdown



        return view('events.index', compact('events', 'categories'));
    }

    // Show Single Event Details
    public function show(Event $event)
    {
        // Guests can only see approved events
        if ($event->status !== 'approved' && !Auth::check()) {
            abort(403, 'This event is pending approval.');
        }

        // ✅ FIX: Load everything in one line (User, Category, Comments, RSVPs, Speakers)
        $event->load(['user', 'category', 'comments.user', 'rsvps', 'speakers']);

        return view('events.show', compact('event'));
    }
    // 3. Show Create Form
    public function create()
    {
        $categories = EventCategory::all();
        return view('events.create', compact('categories'));
    }

    // 4. Store New Event
    public function store(Request $request)
    {
        // Validate Event Details AND Speakers
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'date'        => 'required|date|after:today',
            'time'        => 'required',
            'category_id' => 'required|exists:event_categories,id',
            'image'       => ['required', File::types(['jpg', 'jpeg', 'webp', 'png'])->max(2024)],
            'url'         => 'nullable|url',

            // Speaker Validation (Array)
            'speakers'    => 'nullable|array',
            'speakers.*.name'  => 'nullable|string|max:255',
            'speakers.*.role'  => 'nullable|string|max:255',
            'speakers.*.image' => 'nullable|image|max:2048',
        ]);



        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();


            //saving the eventimages folder
            $file->storeAs('eventimages', $filename, 'public');

            //saving filename to database
            $validated['image'] = $filename;
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $event = Event::create($validated);

        // 3. Loop through and Create Speakers
        // 3. Loop through Speakers
        if ($request->has('speakers')) {
            foreach ($request->speakers as $index => $speakerData) {
                if (empty($speakerData['name'])) continue;

                $speakerImageName = null;

                if ($request->hasFile("speakers.{$index}.image")) {
                    $file = $request->file("speakers.{$index}.image");
                    $speakerImageName = time() . '_spk_' . $index . '_' . $file->getClientOriginalName();
                    $file->storeAs('speakers', $speakerImageName, 'public'); // Changed folder to 'speakers' (no 'public/' prefix needed in storeAs if disk is public)
                }

                EventSpeaker::create([
                    'event_id' => $event->id,
                    'name'     => $speakerData['name'],
                    'role'     => $speakerData['role'] ?? null,
                    'image'    => $speakerImageName,
                ]);
            }

            return redirect()->route('events.index')->with('success', 'Event created successfully! Waiting for approval.');
        }
    }
    //  Show Edit Form
    public function edit(Event $event)
    {
        //  Allow if Owner OR Admin
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        $categories = EventCategory::all();
        return view('events.edit', compact('event', 'categories'));
    }
    //  Update Event
    public function update(Request $request, Event $event)
    {
        // Allow if Owner OR Admin
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'location'    => 'required',
            'date'        => 'required|date',
            'time'        => 'required',
            'category_id' => 'required|exists:event_categories,id',
            'image'       => 'nullable|image|max:2048',
            'url'         => 'nullable|active_url'
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::delete('public/events/' . $event->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('events', $filename);

            $validated['image'] = $filename;
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully.');
    }
    //  Delete Event
    public function destroy(Event $event)
    {
        if (Auth::id() !== $event->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        if ($event->image) {
            Storage::delete('public/events/' . $event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
