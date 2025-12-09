<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLike;
use Illuminate\Support\Facades\Auth;

class EventLikeController extends Controller
{
  public function toggle(Event $event)
  {
    $user = Auth::user();

    $like = EventLike::where('user_id', $user->id)
      ->where('event_id', $event->id)
      ->first();

    if ($like) {
      $like->delete();
      return back(); // Simply refresh page
    } else {
      EventLike::create([
        'user_id' => $user->id,
        'event_id' => $event->id
      ]);
      return back();
    }
  }
}
