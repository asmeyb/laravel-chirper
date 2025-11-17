<?php

namespace App\Observers;

use App\Models\Chirp;
use App\Models\Likable;
use App\Notifications\ChirpLiked;

class LikableObserver
{
    public function created(Likable $likable): void
    {
        // Only send notification if the likable is a Chirp
        if ($likable->likable_type === Chirp::class) {
            $chirp = Chirp::find($likable->likable_id);
            
            if ($chirp && $chirp->user_id !== $likable->user_id) {
                $liker = $likable->user;
                $chirp->user->notify(new ChirpLiked($liker, $chirp));
            }
        }
    }
}
