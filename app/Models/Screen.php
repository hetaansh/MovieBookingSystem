<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Screen extends Model
{
    use HasFactory;

    protected $fillable = [
        'cinema_id',
    ];

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class, 'cinema_id', 'id');
    }

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
