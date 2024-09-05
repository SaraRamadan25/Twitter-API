<?php

// app/Mail/FollowNotification.php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $follower;

    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    public function build()
    {
        return $this->subject('You have a new follower')
            ->view('emails.follow_notification');
    }
}
