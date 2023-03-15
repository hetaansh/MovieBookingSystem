<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_id    ',
        'created_at',
        'updated_at',
        'expired_at',
        
    ];

    public function show(): BelongsTo
    {
        return $this->belongsTo(SHow::class, 'show_id', 'id');
    }
}
