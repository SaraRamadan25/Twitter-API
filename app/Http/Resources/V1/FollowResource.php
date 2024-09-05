<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'follow',
            'id' => $this->id,
            'attributes' => [
                'followed_user_id' => $this->followed_user_id,
                'user_id' => $this->user_id,

            ],
            'links' => [
            ]
        ];
        }
}
