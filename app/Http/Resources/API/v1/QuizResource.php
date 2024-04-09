<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'questions' => QuizQuestionResource::collection($this->questions()->where('is_active', true)->with('options')->orderBy('order')->get()),
        ];
    }

    public static $wrap = '';
}
