<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizQuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'description' => $this->description,
            'order' => $this->order,
            'type' => $this->type,
            'media_url' => [
                '1x' => $this->public_media_url_1x,
                '2x' => $this->public_media_url_2x,
                '3x' => $this->public_media_url_3x,
            ],
            'options' => QuizQuestionOptionResource::collection($this->options->where('is_active', true)->sortBy('order')),
        ];
    }

    public static $wrap = '';
}
