
<div class="card-body">

    <div class="form-group mb-3">
        <label class="form-label" for="name">{{ trans('admin.page.subscription.form.name') }}</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $subscriptionPlan?->name) }}" />
    </div>

    @foreach($subscriptionPlan->imageSizes as $image)
        <div class="mb-3">
            <label class="form-label">{{ trans('admin.page.subscription.form.'.$image) }}</label>
            @if(is_null($subscriptionPlan->getPublicMediaUrl($image)))
                <input accept="image/png, image/jpeg, image/svg+xml" type="file" name="{{$image}}" class="form-control">
            @else
                <div class="form-group">
                    {{ trans('admin.page.subscription.form.remove_image') }}
                    <a href="{{route('admin.subscriptions.plans.remove_image', ['subscriptionPlan' => $subscriptionPlan->id, 'size' => $image])}}" class="btn btn-danger btn-xs" style="width:25px; margin:0; padding-left:25px; height: 25px" title="{{ trans('admin.button.remove_image') }}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" /><path d="M22 22l-5 -5" /><path d="M17 22l5 -5" /></svg>
                    </a>
                </div>
                <img src="{{$subscriptionPlan->getPublicMediaUrl($image)}}" alt="" height="50" />
            @endif
        </div>
    @endforeach


    <div class="form-group mb-3">
        <label for="type" class="form-label">{{ trans('admin.page.subscription.form.type') }}</label>
        @if(!is_null($subscriptionPlan->id))
            <input type="text" class="form-control disabled" name="period" id="period" readonly value="{{ $subscriptionPlan->type?->name}}" />
        @else
            <select class="form-control"  name="type" id="type">
                <option>{{ trans('admin.page.subscription.form.select') }}</option>
                @foreach (\App\Models\Enums\SubscriptionPlanType::cases() as $type)
                    <option value="{{ $type->value }}" @selected(old('type', $subscriptionPlan->type?->value) == $type->value)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>


    <div class="form-group mb-3">
        <label for="period" class="form-label">{{ trans('admin.page.subscription.form.period') }}</label>
        @if($subscriptionPlan?->period)
            <input type="text" class="form-control @if($subscriptionPlan?->period) disabled @endif" name="period" id="period" @readonly($subscriptionPlan?->period) value="{{ old('period', $subscriptionPlan?->period) }}" />
        @else
        <select class="form-control @if($subscriptionPlan?->period) disabled @endif"  name="period" id="period"  @readonly($subscriptionPlan?->period)>
            <option value="">{{ trans('admin.page.subscription.form.select') }}</option>
            @foreach (\App\Models\Enums\SubscriptionPlanPeriodType::cases() as $period)
                <option value="{{ $period->value }}" @selected(old('period', $subscriptionPlan->period?->value) == $period->value)>
                    {{ $period->name }}
                </option>
            @endforeach
        </select>
        @endif
    </div>

    <div class="form-group mb-3">
        <label for="price" class="form-label">{{ trans('admin.page.subscription.form.price') }}</label>
        <input type="text" class="form-control @if($subscriptionPlan?->id) disabled @endif" name="price" id="price" value="{{ old('price', $subscriptionPlan?->price) }}" @readonly($subscriptionPlan?->id)/>
    </div>

    <div class="form-group mb-3">
        <label for="old_price">{{ trans('admin.page.subscription.form.old_price') }}</label>
        <input type="text" class="form-control" name="old_price" id="old_price" value="{{ old('old_price', $subscriptionPlan?->old_price) }}"/>
    </div>



    <div class="form-group mb-3">
        <label for="sort" class="form-label">{{ trans('admin.page.subscription.form.sort') }}</label>
        <input type="text" class="form-control" name="sort" id="sort" value="{{ old('sort', $subscriptionPlan?->sort) }}"/>
    </div>

    <div class="form-group mb-3">
        <div class="row">
        <div class="col-9">
        <label for="configuration" class="form-label">{{ trans('admin.page.subscription.form.configuration') }}</label>
        <textarea class="form-control" rows="10" name="configuration" id="configuration" >{{ old('configuration', $subscriptionPlan?->configuration) }}</textarea>
        </div>
        <div class="col-3">
            <label class="form-label">{{ trans('admin.page.subscription.form.example') }}</label>
            @php
            dumper('{"price_item": {"stripe_desc": "Limited ofer","desc": "$107.97 billed every 3 months", "period": "per month", "save_percentage": null}}')
            @endphp
        </div>
        </div>
    </div>

    @if ($subscriptionPlan->type?->value === \App\Models\Enums\SubscriptionPlanType::SUBSCRIPTION_PLAN->value)
    <div class="form-group mb-3">
        <label for="highlighted_option" class="form-label">{{ trans('admin.page.subscription.form.highlighted_option') }}</label>
        <select class="form-control"  name="highlighted_option" id="highlighted_option">
            <option value="">{{ trans('admin.page.subscription.form.select') }}</option>
            @foreach (\App\Models\Enums\SubscriptionPlanHighlightedOption::cases() as $highlightedOption)
                <option value="{{ $highlightedOption->value }}" @selected(old('highlighted_option', $subscriptionPlan->highlighted_option?->value) == $highlightedOption->value)>
                    {{ $highlightedOption->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="free_gift_id" class="form-label">{{ trans('admin.page.subscription.form.free_gift') }}</label>
        <select class="form-control"  name="free_gift_id" id="free_gift_id">
            <option value="">{{ trans('admin.page.subscription.form.select') }}</option>
            @foreach ($freeGifts as $id => $name)
                <option value="{{ $id }}" @selected(old('free_gift_id', $subscriptionPlan->free_gift_id) == $id)>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>
    @endif

    @if (!is_null($subscriptionPlan->id))
    <livewire:admin.subscription.plan-coupon :subscriptionPlan="$subscriptionPlan" />
    @endif

    <div class="form-check mb-3">
        <input type="checkbox" value="1" class="form-check-input" name="is_hidden" id="is_hidden" @checked(old('is_hidden', $subscriptionPlan?->is_hidden))/>
        <label for="is_hidden">{{ trans('admin.page.subscription.form.is_hidden') }}</label>
    </div>

</div>

<div class="card-footer">
    <div class="form-group ml-auto d-flex">
        <a href="{{route('admin.subscriptions.plans')}}" class="btn ml-0">{{  trans('admin.button.back') }}</a>
        <button type="submit" class="btn btn-primary ms-auto">{{ $submitButton }}</button>
    </div>
</div>

