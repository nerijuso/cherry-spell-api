<?php

namespace App\Livewire\Admin\Dashboard;

use Laravel\Cashier\Subscription;
use Livewire\Component;

class SubscriptionsCount extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.subscriptions-count')->with([
            'subscriptions_count' => Subscription::count(),
            'active_subscriptions_count' => Subscription::where('stripe_status', 'active')->count(),
        ]);
    }
}
