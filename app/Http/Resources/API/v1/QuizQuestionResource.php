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
            'order' => $this->order,
            'type' => $this->type,
            'media_url' => $this->public_media_url,
            'options' => QuizQuestionOptionResource::collection($this->options->where('is_active', true)->sortBy('order')),
        ];
    }

    public static $wrap = '';
}
