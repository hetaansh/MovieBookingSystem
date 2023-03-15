<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'screen_id',
        'price',
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Screen::class, 'screen_id', 'id');
    }
}
