<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\Admin\Subscription\SubscriptionPlanRequest;
use App\Models\Funnel;
use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;

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
        $subscriptionPlan = (new SubscriptionPlan())->create([
            'name' => $request->name,
            'sort' => $request->sort,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'is_hidden' => (bool) $request->is_hidden,
            'is_popular' => (bool) $request->is_popular,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.subscriptions.messages.subscription_plan_created'));

        return redirect(route('admin.subscriptions.plans.edit.edit', ['subscriptionPlan' => $subscriptionPlan->id]));
    }

    public function update(SubscriptionPlan $subscriptionPlan, SubscriptionPlanRequest $request)
    {
        $subscriptionPlan->update([
            'name' => $request->name,
            'sort' => $request->sort,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'is_hidden' => (bool) $request->is_hidden,
            'is_popular' => (bool) $request->is_popular,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.subscription.messages.subscription_plan_updated'));

        return back();
    }
}
