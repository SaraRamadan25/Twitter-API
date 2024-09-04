<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FollowUserRequest;
use App\Models\Follow;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    use ApiResponses;

    public function follow(FollowUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $authenticatedUserId = auth()->id();

        if ($validatedData['followed_user_id'] == $authenticatedUserId) {
            return $this->error('You cannot follow yourself.', 400);
        }

        $validatedData['user_id'] = $authenticatedUserId;

        $existingFollow = Follow::where('user_id', $authenticatedUserId)
            ->where('followed_user_id', $validatedData['followed_user_id'])
            ->first();

        if ($existingFollow) {
            return $this->error('You are already following this user.', 400);
        }

        $follow = Follow::create($validatedData);

        return $this->success('User followed successfully', $follow);
    }
}
