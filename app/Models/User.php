<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class);
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

    public function hasLiked(Model $model): bool
    {
        return $model->likes()->where('user_id', $this->id)->exists();
    }

    public function hasFavorited(Model $model): bool
    {
        return $model->favorites()->where('user_id', $this->id)->exists();
    }

    public function toggleLike(Model $model): void
    {
        $like = $model->likes()->where('user_id', $this->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $model->likes()->create(['user_id' => $this->id]);
        }
    }

    public function toggleFavorite(Model $model): void
    {
        $favorite = $model->favorites()->where('user_id', $this->id)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            $model->favorites()->create(['user_id' => $this->id]);
        }
    }
}
