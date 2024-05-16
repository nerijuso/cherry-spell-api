<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\API\v1\SubscriptionCheckoutRequest;
use App\Http\Resources\API\v1\Subscription\SubscriptionCheckoutResource;
use App\Http\Resources\API\v1\Subscription\UserOrderSummaryResource;
use App\Models\Funnel;
use App\Models\Lead;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function checkout(SubscriptionCheckoutRequest $request, Funnel $funnel)
    {
        $lead = Lead::where('session_id', $request->session_id)->firstOrFail();

        $user = User::firstOrCreate([
            'email' => $lead->email,
        ]);
        $lead->user()->associate($user);
        $lead->setToInitCheckout();
        $lead->save();
        $subscriptionData = [];
        $subscriptionPlan = SubscriptionPlan::where('ref_id', transform_price_id_back($request->plan_id))->first();
        $subscriptionData[] = ['price' => transform_price_id_back($request->plan_id), 'quantity' => 1];

        if ($subscriptionPlan->free_gift_id) {
            $subscriptionData[] = ['price' => $subscriptionPlan->free_gift_id, 'quantity' => 1];
        }

        $checkout = $user->newSubscription('default', $subscriptionData);

        if ($subscriptionPlan->promo_code_id) {
            $checkout = $checkout->withCoupon($subscriptionPlan->promo_code_id);
        } else {
            $checkout = $checkout->allowPromotionCodes();
        }

        $checkout = $checkout->checkout([
            'success_url' => sprintf(config('cashier.success_url'), $funnel->id).'&session_id='.$request->session_id.'&email='.$lead->email,
            'cancel_url' => sprintf(config('cashier.cancel_url'), $funnel->id).'?session_id='.$request->session_id,
        ]);

        return new SubscriptionCheckoutResource($checkout);
    }

    public function userOrderSummary()
    {
        return new UserOrderSummaryResource(auth_user());
    }
}
