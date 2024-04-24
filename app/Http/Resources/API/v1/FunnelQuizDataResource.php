<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FunnelQuizDataResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'session_id' => $this->code,
        ];
    }

    public static $wrap = '';
}
