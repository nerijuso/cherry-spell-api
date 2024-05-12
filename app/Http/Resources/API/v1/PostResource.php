<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->title,
            'image' => [
                'size_1x' => $this->getPublicMediaUrl('size_1x'),
                'size_2x' => $this->getPublicMediaUrl('size_2x'),
                'size_3x' => $this->getPublicMediaUrl('size_3x'),
            ],
            'tags' => TagResource::collection($this->tags),
        ];
    }

    public static $wrap = '';
}
