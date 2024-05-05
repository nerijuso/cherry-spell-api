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
            'is_popular' => $this->is_popular,
            'has_trial' => $this->has_trial,
            'trial_days' => $this->trial_days,
            'currency' => config('cashier.currency'),
            'currency_symbol' => config('cashier.currency_symbol'),
            'sort' => $this->sort,
            'configuration' => $this->configuration,
        ];
    }

    public static $wrap = '';
}
