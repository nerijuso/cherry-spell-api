<?php

namespace App\Http\Resources\API\v1\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'subscription' => new UserSubscriptionSummaryResource($this->subscription()),
            'order_items' => $this->subscription() ?  SubscriptionOrderItemResource::collection($this->subscription()->items): [],
        ];
    }

    public static $wrap = '';
}