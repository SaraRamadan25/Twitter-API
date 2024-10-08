<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TweetResource;
use App\Models\Tweet;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    use ApiResponses;

    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();
        $followedUserIds = $user->follows()->pluck('followed_user_id');
        $tweets = Tweet::whereIn('user_id', $followedUserIds)
            ->latest()
            ->paginate(10);

        $tweets->each(function ($tweet) use ($user) {
            $this->authorize('view', $tweet);
        });
        return $this->success(__('messages.timeline_fetched_successfully'), TweetResource::collection($tweets));
    }
}
