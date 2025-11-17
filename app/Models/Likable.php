<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Likable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likable_id',
        'likable_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likable(): MorphTo
    {
        return $this->morphTo();
    }
}
