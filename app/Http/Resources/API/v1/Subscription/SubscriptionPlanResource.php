<?php

namespace App\Http\Resources\API\v1\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->publicRefId,
            'name' => $this->name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'highlighted_option' => $this->highlighted_option,
            'currency' => config('cashier.currency'),
            'currency_symbol' => config('cashier.currency_symbol'),
            'sort' => $this->sort,
            'configuration' => $this->configuration,
        ];
    }

    public static $wrap = '';
}
