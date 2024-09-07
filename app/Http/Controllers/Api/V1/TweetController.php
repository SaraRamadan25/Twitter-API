<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTweetRequest;
use App\Models\Tweet;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;

class TweetController extends Controller
{
    use ApiResponses;

    public function store(StoreTweetRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        $tweet = Tweet::create($validatedData);

        return $this->success(__('messages.tweet_created_successfully'));
    }
}
