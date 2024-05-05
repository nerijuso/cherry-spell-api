<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\API\v1\SubscriptionCheckoutRequest;
use App\Http\Requests\API\v1\SubscriptionCheckoutValidateRequest;
use App\Http\Resources\API\DefaultResource;
use App\Http\Resources\API\v1\CheckoutValidationResource;
use App\Http\Resources\API\v1\Subscription\SubscriptionCheckoutResource;
use App\Http\Resources\API\v1\Subscription\UserSubscriptionSummaryResource;
use App\Models\Funnel;
use App\Models\Lead;
use App\Models\User;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    public function checkout(SubscriptionCheckoutRequest $request, Funnel $funnel)
    {
        $lead = Lead::where('session_id', $request->session_id)->firstOrFail();

        $user = User::firstOrCreate([
            'email' => $lead->email,
        ]);
        $lead->user()->associate($user);
        $lead->save();

        return new SubscriptionCheckoutResource(
            $user
                ->newSubscription('default', transform_price_id_back($request->plan_id))
                ->allowPromotionCodes()
                ->checkout([
                    'success_url' => sprintf(config('cashier.success_url'), $funnel->id).'&session_id='.$request->session_id.'&email='.$lead->email,
                    'cancel_url' => sprintf(config('cashier.cancel_url'), $funnel->id).'?session_id='.$request->session_id,
                ]));
    }

    public function validateCheckout(SubscriptionCheckoutValidateRequest $request)
    {
        $sessionId = $request->get('checkout_session_id');

        if ($sessionId === null) {
            return (new CheckoutValidationResource([
                'status' => 'failed',
                'user_email' => null,
                'message' => trans('kernel.messages.subscription_session_not_defined'),
            ]))->response()->setStatusCode(406);
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return (new CheckoutValidationResource([
                'status' => 'failed',
                'user_email' => $session?->customer_details?->email,
                'message' => trans('kernel.messages.subscription_is_not_payed'),
            ]))->response()->setStatusCode(406);
        }

        return (new CheckoutValidationResource([
            'status' => 'success',
            'user_email' => $session->customer_details->email,
            'message' => trans('kernel.messages.subscription_payed'),
        ]))->response()->setStatusCode(200);
    }

    public function userSubscriptionSummary()
    {
        $subscription = auth_user()->subscription();

        if (! $subscription) {
            return (new DefaultResource([
                'status' => 'error',
                'message' => trans('kernel.messages.subscription_does_not_exist'),
            ]))->response()->setStatusCode(406);
        }

        return new UserSubscriptionSummaryResource($subscription);
    }
}
