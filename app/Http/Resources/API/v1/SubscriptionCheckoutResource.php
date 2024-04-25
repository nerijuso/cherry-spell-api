<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionCheckoutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'redirect_url' => $this->url,
        ];
    }

    public static $wrap = '';
}
