<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Chirp extends Model
{
    protected $fillable = [
        'message',
        'original_chirp_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Likable::class, 'likable');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favoritable::class, 'favoritable');
    }

    public function originalChirp(): BelongsTo
    {
        return $this->belongsTo(Chirp::class, 'original_chirp_id');
    }

    public function reposts(): HasMany
    {
        return $this->hasMany(Chirp::class, 'original_chirp_id');
    }

    protected function isRepost(): Attribute
    {
        return Attribute::make(
            get: fn () => !is_null($this->original_chirp_id),
        );
    }
}
