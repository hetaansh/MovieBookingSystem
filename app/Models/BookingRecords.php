<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'cinema',
        'movie',
        'screen',
        'show',
        'seat_array',
    ];
}
