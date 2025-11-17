<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\ChirpCommented;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        $chirp = $comment->chirp;
        
        // Only send notification if the commenter is not the chirp author
        if ($chirp->user_id !== $comment->user_id) {
            $commenter = $comment->user;
            $chirp->user->notify(new ChirpCommented($commenter, $chirp, $comment->content));
        }
    }
}
