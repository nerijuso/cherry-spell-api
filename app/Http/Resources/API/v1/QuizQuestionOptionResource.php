<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizQuestionOptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order' => $this->order,
            'option' => $this->option,
            'media_url' => [
                '1x' => $this->public_media_url_1x,
                '2x' => $this->public_media_url_2x,
                '3x' => $this->public_media_url_3x,
            ],
        ];
    }

    public static $wrap = '';
}
