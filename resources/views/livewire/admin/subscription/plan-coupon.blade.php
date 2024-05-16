<div class="form-group mb-3">
    <label for="promo_code_id" class="form-label">{{ trans('admin.page.subscription.form.promo_code') }}</label>
    <div class="row">
        @if (is_null($subscriptionPlan->promo_code_id))
            <button type="button" class="btn btn-primary col-2" wire:click="showModalPopup()" >
                Assign discount
            </button>
        @else
            <div class="col-lg-6">
            <input readonly disabled class="form-control" value="{{$subscriptionPlan->promo_code_id}}">
            </div>
            <div class="col-lg-6">
            <button wire:click="removeCoupon()" type="button" class="btn btn-danger">{{ trans('admin.page.subscription.buttons.remove_coupon') }}</button>
            </div>
        @endif
    </div>
    @if($showModal)
        <div class="modal-backdrop show"></div>
        <div class="modal d-block" tabindex="-1" wire:click.self="$set('showModal', false)">
        <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('admin.page.subscription.form.new_coupon') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('admin.page.subscription.form.coupon_name') }}</label>
                                    <input type="text" class="form-control" wire:model="name"/>
                                    <div class="text-danger">@error('name') {{ $message }} @enderror</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label
                                        class="form-label">{{ trans('admin.page.subscription.form.percentage') }}</label>
                                    <input type="number" class="form-control" wire:model="percentage"/>
                                    <div class="text-danger">@error('percentage') {{ $message }} @enderror</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary text-left me-auto align-left" wire:click.self="$set('showModal', false)" data-bs-dismiss="modal">
                            {{ trans('admin.button.cancel') }}
                        </button>
                        <button class="btn btn-primary" type="button" wire:click.prevent="save">
                            {{ trans('admin.page.subscription.buttons.create_new_coupon') }}
                        </button>
                    </div>
                </div>
        </div>
        </div>
        @endif
</div>
