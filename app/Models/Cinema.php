<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'pincode',
        'address',
        'city_id',
        'operator_id',
        'release_at',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function screens(): HasMany
    {
        return $this->hasMany(Screen::class);
    }
}
