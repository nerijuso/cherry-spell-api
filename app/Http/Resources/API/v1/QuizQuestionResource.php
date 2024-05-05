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
            'image' => [
                'size_1x' => $this->getPublicMediaUrl('size_1x'),
                'size_2x' => $this->getPublicMediaUrl('size_2x'),
                'size_3x' => $this->getPublicMediaUrl('size_3x'),
            ],
            'image_mobile' => [
                'size_1x' => $this->getPublicMediaUrl('size_mobile_1x'),
                'size_2x' => $this->getPublicMediaUrl('size_mobile_2x'),
                'size_3x' => $this->getPublicMediaUrl('size_mobile_3x'),
            ],
            'options' => QuizQuestionOptionResource::collection($this->options->where('is_active', true)->sortBy('order')),
        ];
    }

    public static $wrap = '';
}
