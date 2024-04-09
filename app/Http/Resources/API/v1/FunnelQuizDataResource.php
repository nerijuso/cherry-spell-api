<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FunnelQuizDataResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'configuration' => $this->configuration,
            'quiz' => new QuizResource($this->quiz()->where('is_published', true)->first()),
        ];
    }

    public static $wrap = '';
}
