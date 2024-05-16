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
        $subscriptionPlan->highlighted_option = $request->highlighted_option;
        $subscriptionPlan->configuration = json_decode($request->configuration);
        $subscriptionPlan->free_gift_id = $request->free_gift_id;
        $subscriptionPlan->save();
        $subscriptionPlan->saveFile($request->{'size_1x'}, null, 'size_1x');

        $price = Cashier::stripe()->prices->retrieve($subscriptionPlan->ref_id);

        $data = [
            'name' => $subscriptionPlan->name,
            'description' => data_get($subscriptionPlan->configuration, 'price_item.stripe_desc'),
        ];

        if ($subscriptionPlan->media_file) {
            $data['images'] = [$subscriptionPlan->getPublicMediaUrl('size_1x')];
        }

        Cashier::stripe()->products->update($price->product, $data);

        return $subscriptionPlan;
    }
}
