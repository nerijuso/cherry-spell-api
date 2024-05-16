<?php

namespace App\Actions\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Laravel\Cashier\Cashier;

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
        $subscriptionPlan->highlighted_option = $request->highlighted_option;
        $subscriptionPlan->configuration = json_decode($request->configuration);
        $subscriptionPlan->period = $request->period;
        $subscriptionPlan->save();
        $subscriptionPlan->saveFile($request->{'size_1x'}, null, 'size_1x');

        $productData = [];
        $priceData = [];
        $productData['name'] = $subscriptionPlan->name;
        $priceData['name'] = $subscriptionPlan->name;

        if ($subscriptionPlan->media_file) {
            $productData['images'] = [$subscriptionPlan->getPublicMediaUrl('size_1x')];
        }

        $desc = data_get($subscriptionPlan->configuration, 'price_item.stripe_desc');
        if ($desc) {
            $priceData['description'] = $desc;
        }

        $price = Cashier::stripe()->prices->create([
            'unit_amount' => $request->price * 100,
            'currency' => config('cashier.currency'),
            'recurring' => [
                'interval' => $subscriptionPlan->period->value,
            ],
            'product_data' => $productData,
        ]);

        Cashier::stripe()->products->update($price->product, $priceData);

        $subscriptionPlan->product_ref_id = $price->product;
        $subscriptionPlan->ref_id = $price->id;
        $subscriptionPlan->save();

        return $subscriptionPlan;
    }
}
