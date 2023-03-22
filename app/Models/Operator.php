<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Operator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city_id'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function operator_users(): HasMany
    {
        return $this->hasMany(OperatorUser::class);
    }

    public function cinemas(): HasMany
    {
        return $this->hasMany(Cinema::class);
    }

    public function screens(): HasManyThrough
    {
        return $this->hasManyThrough(Screen::class, Cinema::class, 'operator_id', 'cinema_id', 'id');
    }

    public function shows(): HasManyThrough
    {
        return $this->hasManyThrough();
    }
}
