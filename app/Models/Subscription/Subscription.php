<?php

namespace App\Models\Subscription;

use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    public function subscriptionPlan()
    {
        return $this->hasOne(SubscriptionPlan::class, 'ref_id', 'stripe_price');
    }
}
