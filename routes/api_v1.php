<?php

use App\Http\Controllers\Api\V1\FollowController;
use App\Http\Controllers\Api\V1\TimelineController;
use App\Http\Controllers\Api\V1\TweetController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

Route::post('tweets', [TweetController::class, 'store']);
Route::post('follow', [FollowController::class, 'follow']);
Route::get('timeline', [TimelineController::class, 'index']);
});
