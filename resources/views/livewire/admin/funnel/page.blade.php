<div>
    <div class="row">
        <div class="col-sm-8">
            <h3>Enabled pages:</h3>
            <ul class="list-group">
                @foreach($funnelPages as $page)
                    <li class="list-group-item d-flex justify-content-between align-items-left @if(!$page->is_active) bg-muted-lt @endif">
                        <strong>{{ $page->position }}. {{ $availablePages->firstWhere('id', $page->type)['name'] }} </strong><br>
                        <div class="btn-group btn-group-xs pull-right" role="group">
                            @if (!$loop->first)
                                <button wire:click="changePosition('{{ $page->id }}', {{ $page->position }}, {{ $page->position - 1 }})" class="btn btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M18 11l-6 -6" /><path d="M6 11l6 -6" /></svg>
                                </button>
                            @endif
                            @if (!$loop->last)
                                <button wire:click="changePosition('{{ $page->id }}', {{ $page->position }}, {{ $page->position +1 }})" class="btn btn-sm">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M18 13l-6 6" /><path d="M6 13l6 6" /></svg>
                                </button>
                            @endif
                            @if($page->is_active)
                                <button wire:click="disable('{{ $page->id }}')" type="button" class="btn btn-danger btn-sm" title="Disable">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                                </button>
                            @else
                                <button wire:click="enable('{{ $page->id }}')" type="button" class="btn btn-success btn-sm" title="Enable">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                </button>
                            @endif
                               &nbsp;
                               <button wire:click="configure('{{ $page->id }}')" class="btn btn-sm btn-success @if(!$page->is_active) disabled @endif">
                                    Configure
                               </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-4">
            <h3>Available page types:</h3>
            <ul class="list-group">
                @foreach($availablePages as $availablePage)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $availablePage['name'] }}
                        <button wire:click="create('{{ $availablePage['id']}}')" type="button" class="btn btn-sm btn-success pull-right">
                            Create new page
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @if($showModal)
        <div class="modal-backdrop show"></div>
        <div class="modal d-block" tabindex="-1" wire:click.self="$set('showModal', false)">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configure funnel page</h5>
                    <button type="button" wire:click.self="$set('showModal', false)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <livewire:dynamic-component :is="$component" :funnelPage="$funnelPage"/>

            </div>
        </div>
    </div>
    @endif

</div>


