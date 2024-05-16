<?php

namespace App\Livewire\Admin\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlanCoupon extends Component
{
    public SubscriptionPlan $subscriptionPlan;

    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|integer|min:1|max:100')]
    public $percentage = 0;

    public $showModal = false;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.admin.subscription.plan-coupon')->with([
        ]);
    }

    public function showModalPopup(): void
    {
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $price = Cashier::stripe()->coupons->create([
                'name' => $this->name,
                'duration' => 'forever',
                'percent_off' => $this->percentage,
                'applies_to' => [
                    'products' => [
                        $this->subscriptionPlan->product_ref_id,
                    ],
                ],
            ]);

            $this->subscriptionPlan->promoCode()->create([
                'name' => $this->name,
                'id' => $price->id,
                'is_active' => true,
            ]);

            $this->subscriptionPlan->promo_code_id = $price->id;
            $this->subscriptionPlan->save();
        });

        $this->showModal = false;
    }

    public function removeCoupon(): void
    {
        DB::transaction(function () {
            Cashier::stripe()->coupons->delete($this->subscriptionPlan->promo_code_id);
            $this->subscriptionPlan->promo_code_id = null;
            $this->subscriptionPlan->save();
        });
    }
}
