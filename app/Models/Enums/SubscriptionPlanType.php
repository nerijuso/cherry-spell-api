<?php

namespace App\Models\Enums;

enum SubscriptionPlanType: string
{
    case SUBSCRIPTION_PLAN = 'subscription_plan';

    case SUBSCRIPTION_GIFT = 'subscription_gift';
}
