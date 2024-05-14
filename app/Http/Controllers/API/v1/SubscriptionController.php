<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\API\v1\SubscriptionCheckoutRequest;
use App\Http\Resources\API\DefaultResource;
use App\Http\Resources\API\v1\Subscription\SubscriptionCheckoutResource;
use App\Http\Resources\API\v1\Subscription\UserOrderSummaryResource;
use App\Http\Resources\API\v1\Subscription\UserSubscriptionSummaryResource;
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
                ->newSubscription('default', transform_price_id_back($request->plan_id))
              //  ->newSubscription('default', [ transform_price_id_back($request->plan_id), 'price_1PG1jDLpRSg6kmye7y9L0rLC'])
                ->allowPromotionCodes()
               // ->withCoupon('v6RERRhs')
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
