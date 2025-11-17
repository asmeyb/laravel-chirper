<?php

namespace App\Notifications;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ChirpCommented extends Notification
{
    use Queueable;

    public function __construct(
        public User $commenter,
        public Chirp $chirp,
        public string $commentContent
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'commenter_id' => $this->commenter->id,
            'commenter_name' => $this->commenter->name,
            'chirp_id' => $this->chirp->id,
            'comment_content' => $this->commentContent,
            'action' => 'commented',
        ];
    }
}
