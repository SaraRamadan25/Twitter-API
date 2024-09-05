<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FollowedUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $follower;
    public $followedUserId;

    public function __construct(User $follower, $followedUserId)
    {
        $this->follower = $follower;
        $this->followedUserId = $followedUserId;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.' . $this->followedUserId);
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->follower->username . ' has followed you.',
        ];
    }
}
