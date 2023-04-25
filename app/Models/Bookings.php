<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'cinema_id',
        'movie_id',
        'screen_id',
        'show_id',
        'seat_array',
    ];
}
