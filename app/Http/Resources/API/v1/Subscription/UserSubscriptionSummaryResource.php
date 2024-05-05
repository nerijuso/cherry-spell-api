<?php

namespace App\Http\Resources\API\v1\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource['id'],
            'is_active' => $this->active(),
            'plan' => new SubscriptionPlanResource($this->subscriptionPlan),
        ];
    }

    public static $wrap = '';
}
