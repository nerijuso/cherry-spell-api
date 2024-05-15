<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\API\v1\SubscriptionCheckoutRequest;
use App\Http\Resources\API\v1\Subscription\SubscriptionCheckoutResource;
use App\Http\Resources\API\v1\Subscription\UserOrderSummaryResource;
use App\Models\Funnel;
use App\Models\Lead;
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

        return new SubscriptionCheckoutResource(
            $user
             //   ->newSubscription('default', transform_price_id_back($request->plan_id))
                ->newSubscription('default', [['price' => 'price_1PGRu3LpRSg6kmyeKkaKrOgN', 'quantity' => 1],  ['price' => transform_price_id_back($request->plan_id), 'quantity' => 1], ])

              //  ->allowPromotionCodes()
             //   ->withCoupon('v6RERRhs')
                ->checkout([
                    'success_url' => sprintf(config('cashier.success_url'), $funnel->id).'&session_id='.$request->session_id.'&email='.$lead->email,
                    'cancel_url' => sprintf(config('cashier.cancel_url'), $funnel->id).'?session_id='.$request->session_id,
                ]));
    }

    public function userOrderSummary()
    {
        return new UserOrderSummaryResource(auth_user());
    }
}
