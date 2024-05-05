<?php

namespace App\Livewire\Admin\Funnel;

use App\Models\Funnel;
use App\Models\FunnelPage;
use App\Services\Funnel\FunnelPageService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Page extends Component
{
    public Funnel $funnel;

    public $funnelPages;

    public $showModal = false;

    public FunnelPage $funnelPage;

    public string $component;

    public function mount()
    {
        $this->funnelPages = $this->funnel->funnelPages()->orderBy('position')->get();

    }

    public function render()
    {
        $availablePages = collect(app(FunnelPageService::class)->getPagesTypes())->transform(function ($item, $key) {
            return [
                'id' => $item->getID(),
                'name' => $item->getName(),
            ];
        });

        return view('livewire.admin.funnel.page', [
            'availablePages' => $availablePages,
        ]);
    }

    public function create(string $type): void
    {
        $position = $this->funnel->funnelPages->count() + 10;
        $this->funnel->funnelPages()->create([
            'position' => $position,
            'type' => $type,
        ]);

        $this->reIndexNextPageId();
        $this->funnelPages = $this->funnel->funnelPages()->orderBy('position')->get();
    }

    private function reIndexNextPageId(): void
    {
        DB::table('funnel_pages')->where('is_active', 0)->where('funnel_id', $this->funnel->id)->update(['next_page_id' => null]);

        $funnelPages = $this->funnel->funnelPages()->where('is_active', true)->orderBy('position')->get();
        $funnelPages->each(function ($item) use ($funnelPages) {
            $nextPage = $funnelPages->firstWhere('position', '>', $item->position);
            $item->next_page_id = $nextPage?->id;
            $item->save();
        });
    }

    public function disable(int $id): void
    {
        $this->funnel->funnelPages()->where('id', $id)->update(['is_active' => false]);
        $this->reIndexNextPageId();
        $this->funnelPages = $this->funnel->funnelPages()->orderBy('position')->get();
    }

    public function enable(int $id): void
    {
        $this->funnel->funnelPages()->where('id', $id)->update(['is_active' => true]);
        $this->reIndexNextPageId();
        $this->funnelPages = $this->funnel->funnelPages()->orderBy('position')->get();
    }

    public function changePosition(int $id, int $prevPos, int $newPos): void
    {
        $this->funnelPages = $this->funnelPages
            ->map(function ($data, string $key) use ($id, $prevPos, $newPos) {

                if ($data->id === $id) {
                    $data->position = $newPos;
                }

                if ($data->id !== $id && $data->position === $newPos) {
                    $data->position = $prevPos;
                }

                $data->save();

                return $data;
            })->sortBy('position');
        $this->reIndexNextPageId();
        $this->funnelPages = $this->funnel->funnelPages()->orderBy('position')->get();
    }

    public function configure(int $id)
    {
        $this->showModal = true;
        $this->funnelPage = $this->funnelPages->firstWhere('id', $id);
        $this->component = 'admin.funnel.page-type.'.str_replace('_', '-', $this->funnelPage->type);
    }

    #[On('modal-closed')]
    public function hideModal()
    {
        $this->showModal = false;
    }
}
