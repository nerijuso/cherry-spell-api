<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Actions\Subscription\CreateSubscriptionPlan;
use App\Actions\Subscription\UpdateSubscriptionPlan;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\Admin\Subscription\SubscriptionPlanRequest;
use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlansController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function plans(Request $request)
    {
        $query = SubscriptionPlan::query();
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->input('name').'%');
        }

        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.subscription.plans.index', ['items' => $items]);
    }

    public function create(SubscriptionPlan $subscriptionPlan)
    {
        return view('admin.pages.subscription.plans.create', [
            'subscriptionPlan' => $subscriptionPlan,
        ]);
    }

    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('admin.pages.subscription.plans.edit', [
            'subscriptionPlan' => $subscriptionPlan,
        ]);
    }

    public function store(SubscriptionPlanRequest $request)
    {
        $subscriptionPlan = (new CreateSubscriptionPlan())($request);

        $request->session()->flash('alert-success', trans('admin.page.subscription.messages.subscription_plan_created'));

        return redirect(route('admin.subscriptions.plans.edit', ['subscriptionPlan' => $subscriptionPlan->id]));
    }

    public function update(SubscriptionPlan $subscriptionPlan, SubscriptionPlanRequest $request)
    {
        (new UpdateSubscriptionPlan())($subscriptionPlan, $request);

        $request->session()->flash('alert-success', trans('admin.page.subscription.messages.subscription_plan_updated'));

        return back();
    }
}
