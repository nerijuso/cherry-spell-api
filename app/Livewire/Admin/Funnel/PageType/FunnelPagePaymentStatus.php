<?php

namespace App\Livewire\Admin\Funnel\PageType;

use App\Models\FunnelPage;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FunnelPagePaymentStatus extends Component
{
    public FunnelPage $funnelPage;

    #[Validate('required|json')]
    public $configuration = [];

    public function mount()
    {
        $this->configuration = json_encode($this->funnelPage->configuration);
    }

    public function render()
    {
        return view('livewire.admin.funnel.page-type');
    }

    public function save()
    {
        $this->validate();

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
