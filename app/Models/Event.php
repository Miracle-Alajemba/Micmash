<?php

namespace App\Models;

use App\Models\EventSpeaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'category_id',
    'title',
    'description',
    'location',
    'date',
    'time',
    'image',
    'status',
    'url'
  ];

  // The Creator
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // The Category
  public function category()
  {
    return $this->belongsTo(EventCategory::class);
  }

  // RSVPs (People who joined)
  public function rsvps()
  {
    return $this->hasMany(EventRsvp::class);
  }

  // Likes
  public function likes()
  {
    return $this->hasMany(EventLike::class);
  }

  // Comments
  public function comments()
  {
    return $this->hasMany(EventComment::class);
  }

  // Helper: Check if a specific user liked this event
  public function isLikedBy(User $user)
  {
    return $this->likes()->where('user_id', $user->id)->exists();
  }

  // Helper: Check if a specific user joined this event
  public function isJoinedBy(User $user)
  {
    return $this->rsvps()->where('user_id', $user->id)->exists();
  }
  // Speakers
  public function speakers()
  {
    return $this->hasMany(EventSpeaker::class);
  }
}
