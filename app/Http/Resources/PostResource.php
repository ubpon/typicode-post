<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'type' => 'posts',
            'attributes' => [
                'title' => $this['title'],
                'body' => $this['body'],
                'user_id' => $this['userId'],
            ],
        ];
    }
}
