<?php

namespace App\Livewire\Admin\Funnel\PageType;

use App\Models\FunnelPage;
use App\Services\Funnel\FunnelPageService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FunnelPagePlans extends Component
{
    public FunnelPage $funnelPage;

    #[Validate('required|json')]
    public $configuration = [];

    public $plansID = [];

    public $subscriptionPlans = [];

    public $selectedSubscriptionPlans = [];

    public function mount()
    {
        $this->selectedSubscriptionPlans = data_get($this->funnelPage->data, 'subscription_plan_ids', []);
        $this->configuration = json_encode($this->funnelPage->configuration);
        $this->subscriptionPlans = app(FunnelPageService::class)->loadFormData($this->funnelPage->type)['subscription_plans'];
    }

    public function render()
    {
        return view('livewire.admin.funnel.page-type');
    }

    public function save()
    {
        $this->validate();

        $data = $this->funnelPage->data;
        data_set($data, 'subscription_plan_ids', $this->selectedSubscriptionPlans);

        $this->funnelPage->data = $data;
        $this->funnelPage->configuration = json_decode($this->configuration);
        $this->funnelPage->save();
        $this->dispatch('modal-closed');
        session()->flash('status', 'Successfully updated.');
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }
}
