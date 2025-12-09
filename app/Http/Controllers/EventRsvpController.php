<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRsvp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRsvpController extends Controller
{
  public function toggle(Event $event)
  {
    $user = Auth::user();

    // Check if already joined
    $rsvp = EventRsvp::where('user_id', $user->id)
      ->where('event_id', $event->id)
      ->first();

    if ($rsvp) {
      $rsvp->delete(); // Leave event
      return back()->with('success', 'You have left the event.');
    } else {
      EventRsvp::create([
        'user_id' => $user->id,
        'event_id' => $event->id
      ]);
      return back()->with('success', 'You have joined the event!');
    }
  }
}
