<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventCommentController extends Controller
{
  public function store(Request $request, Event $event)
  {
    $request->validate(['content' => 'required|string|max:500']);

    EventComment::create([
      'user_id' => Auth::id(),
      'event_id' => $event->id,
      'content' => $request->comment
    ]);

    return back()->with('success', 'Comment posted.');
  }
}
