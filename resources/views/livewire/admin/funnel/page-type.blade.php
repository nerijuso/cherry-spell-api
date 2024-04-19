<div>
    <form wire:submit="save">
    <div class="modal-body">
        @include('livewire.admin.funnel.page-type.'.str_replace('_', '-', $funnelPage->type))

        <div class="col-lg-12">
            <div class="mb-3">
                <label class="form-label">Configuration</label>
                <textarea width="100%" rows="10"  class="form-control" name="configuration" wire:model="configuration" ></textarea>
                <div class="text-danger">@error('configuration') {{ $message }} @enderror</div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal" wire:click="$parent.$set('showModal', false)">Close</button>
        <button  class="btn btn-primary" data-bs-dismiss="modal" type="submit" >Save changes</button>
    </div>
    </form>
</div>


