<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller as Controller;
use App\Http\Resources\API\v1\SubscriptionCheckoutResource;
use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;
use Stripe\Checkout\Session;

class SubscriptionController extends Controller
{
    public function checkout(Request $request, $funnelID)
    {
        //@TODO add plan validation request
        $subscriptionPlan = SubscriptionPlan::wherePriceId($request->plan_id)->firstOrFail();

        return new SubscriptionCheckoutResource(
            Checkout::guest()
            ->allowPromotionCodes()
            ->create($subscriptionPlan->ref_id, [
            'mode' => Session::MODE_SUBSCRIPTION,
            'success_url' => sprintf(config('cashier.success_url'), $funnelID),
            'cancel_url' => sprintf(config('cashier.cancel_url'), $funnelID),
        ]));
    }
}
