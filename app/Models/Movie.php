<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'director',
        'movie_cast',
        'release_at',
    ];

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }
}
