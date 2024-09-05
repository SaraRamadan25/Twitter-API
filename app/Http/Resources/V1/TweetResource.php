<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'tweet',
            'id' => $this->id,
            'attributes' => [
                'content' => $this->text,
                'user_id' => $this->user_id,
            ],
            'links' => [
            ]
        ];
    }
}
