<?php

namespace App\Notifications;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ChirpLiked extends Notification
{
    use Queueable;

    public function __construct(
        public User $liker,
        public Chirp $chirp
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
            'chirp_id' => $this->chirp->id,
            'chirp_message' => $this->chirp->message,
            'action' => 'liked',
        ];
    }
}
