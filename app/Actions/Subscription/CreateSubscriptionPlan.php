<?php

namespace App\Actions\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Laravel\Cashier\Cashier;
use Stripe\Price;

class CreateSubscriptionPlan
{
    public function __invoke($request): SubscriptionPlan
    {
        $subscriptionPlan = new SubscriptionPlan();
        $subscriptionPlan->name = $request->name;
        $subscriptionPlan->sort = $request->sort;
        $subscriptionPlan->price = $request->price;
        $subscriptionPlan->old_price = $request->old_price;
        $subscriptionPlan->is_hidden = (bool) $request->is_hidden;
        $subscriptionPlan->is_popular = (bool) $request->is_popular;
        $subscriptionPlan->description = '{}';
        $subscriptionPlan->save();

        $price = Cashier::stripe()->prices->create([
            'unit_amount' => $request->price * 100,
            'currency' => config('cashier.currency'),
            'recurring' => [
                'interval' => 'month' //day, week, month or year.
            ],
            'product_data' => [
                'name' => $subscriptionPlan->name
            ]
        ]);

        $subscriptionPlan->ref_id = $price->id;
        $subscriptionPlan->save();

        return $subscriptionPlan;
    }
}
