<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given tweet can be viewed by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tweet  $tweet
     * @return bool
     */
    public function view(User $user, Tweet $tweet): bool
    {
        return $user->follows()->where('followed_user_id', $tweet->user_id)->exists();
    }
}
