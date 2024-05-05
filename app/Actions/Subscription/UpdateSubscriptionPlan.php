<?php

namespace App\Actions\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Laravel\Cashier\Cashier;

class UpdateSubscriptionPlan
{
    public function __invoke($subscriptionPlan, $request): SubscriptionPlan
    {
        $subscriptionPlan->name = $request->name;
        $subscriptionPlan->sort = $request->sort;
        $subscriptionPlan->old_price = $request->old_price;
        $subscriptionPlan->is_hidden = (bool) $request->is_hidden;
        $subscriptionPlan->is_popular = (bool) $request->is_popular;
        $subscriptionPlan->configuration = $request->configuration;
        $subscriptionPlan->save();

        $price = Cashier::stripe()->prices->retrieve($subscriptionPlan->ref_id);
        Cashier::stripe()->products->update($price->product, [
            'name' => $subscriptionPlan->name,
        ]);

        return $subscriptionPlan;
    }
}
