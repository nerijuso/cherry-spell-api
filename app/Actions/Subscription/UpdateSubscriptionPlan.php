<?php

namespace App\Actions\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Stripe\Price;
use Stripe\Product;


class UpdateSubscriptionPlan
{
    public function __invoke($subscriptionPlan, $request): SubscriptionPlan
    {
        $subscriptionPlan->name = $request->name;
        $subscriptionPlan->sort = $request->sort;
        $subscriptionPlan->old_price = $request->old_price;
        $subscriptionPlan->is_hidden = (bool) $request->is_hidden;
        $subscriptionPlan->is_popular = (bool) $request->is_popular;
        $subscriptionPlan->description = '{}';
        $subscriptionPlan->save();

        $price = Price::retrieve($subscriptionPlan->ref_id);
        Product::update($price->product, [
            'name' => $subscriptionPlan->name
        ]);

        return $subscriptionPlan;
    }
}
