<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'event_name',
        'user_id',
        'seat_number',
        // …other columns
    ];
}
