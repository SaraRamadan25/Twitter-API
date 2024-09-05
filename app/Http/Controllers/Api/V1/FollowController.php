<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\FollowedUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FollowUserRequest;
use App\Mail\FollowNotification;
use App\Models\Follow;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class FollowController extends Controller
{
    use ApiResponses;

    public function follow(FollowUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $authenticatedUserId = auth()->id();

        if ($validatedData['followed_user_id'] == $authenticatedUserId) {
            return $this->error(__('messages.cannot_follow_self'), 400);
        }

        $validatedData['user_id'] = $authenticatedUserId;

        $existingFollow = Follow::where('user_id', $authenticatedUserId)
            ->where('followed_user_id', $validatedData['followed_user_id'])
            ->first();

        if ($existingFollow) {
            return $this->error(__('messages.already_following'), 400);
        }

        $follow = Follow::create($validatedData);

        $followedUser = User::find($validatedData['followed_user_id']);
        Mail::to($followedUser->email)->send(new FollowNotification(auth()->user()));

        event(new FollowedUser(auth()->user(), $validatedData['followed_user_id']));

        return $this->success(__('messages.user_followed'), $follow);
    }}
