<?php

namespace App\Services\Funnel\PageTypes;

use App\Http\Resources\API\v1\SubscriptionPlanResource;
use App\Models\Subscription\SubscriptionPlan;
use App\Services\Funnel\FunnelPageType;

class FunnelPagePlans extends FunnelPageType
{
    public function getName(): string
    {
        return 'List of payment plans';
    }

    public function getData(): array
    {
        return [
            'subscription_plans' => SubscriptionPlan::where('is_hidden', 0)->get(),
        ];
    }

    public function getResource($funnelPage): array
    {

        return [
            'subscription_plans' => SubscriptionPlanResource::collection($funnelPage->subscriptionPlans),
        ];
    }
}
