
<div class="card-body">

    <div class="form-group mb-3">
        <label for="name">{{ trans('admin.page.subscription.form.name') }}</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $subscriptionPlan?->name) }}" />
    </div>

    <div class="form-group mb-3">
        <label for="period">{{ trans('admin.page.subscription.form.period') }}</label>
        @if(!$subscriptionPlan?->period)
            <input type="text" class="form-control @if($subscriptionPlan?->period) disabled @endif" name="period" id="period" @readonly($subscriptionPlan?->period) value="{{ old('period', $subscriptionPlan?->period) }}" />
        @else
        <select class="form-control @if($subscriptionPlan?->period) disabled @endif"  name="period" id="period"  @readonly($subscriptionPlan?->period)>
            @foreach (\App\Models\Enums\SubscriptionPlanPeriodType::cases() as $period)
                <option value="{{ $period->value }}" @selected(old('period', $subscriptionPlan->period) == $period->value)>
                    {{ $period->name }}
                </option>
            @endforeach
        </select>
        @endif
    </div>

    <div class="form-group mb-3">
        <label for="old_price">{{ trans('admin.page.subscription.form.old_price') }}</label>
        <input type="text" class="form-control" name="old_price" id="old_price" value="{{ old('old_price', $subscriptionPlan?->old_price) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="price">{{ trans('admin.page.subscription.form.price') }}</label>
        <input type="text" class="form-control @if($subscriptionPlan?->id) disabled @endif" name="price" id="price" value="{{ old('price', $subscriptionPlan?->price) }}" @readonly($subscriptionPlan?->id)/>
    </div>

    <div class="form-group mb-3">
        <label for="sort">{{ trans('admin.page.subscription.form.sort') }}</label>
        <input type="text" class="form-control" name="sort" id="sort" value="{{ old('sort', $subscriptionPlan?->sort) }}"/>
    </div>

    <div class="form-group mb-3">
        <label for="configuration">{{ trans('admin.page.subscription.form.configuration') }}</label>
        <textarea class="form-control" rows="20" name="configuration" id="configuration" >{{ old('configuration', $subscriptionPlan?->configuration) }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="highlighted_option">{{ trans('admin.page.subscription.form.highlighted_option') }}</label>
        <select class="form-control"  name="highlighted_option" id="highlighted_option">
            @foreach (\App\Models\Enums\SubscriptionPlanHighlightedOption::cases() as $highlightedOption)
                <option value="{{ $highlightedOption->value }}" @selected(old('highlighted_option', $subscriptionPlan->highlighted_option) == $highlightedOption->value)>
                    {{ $highlightedOption->name }}
                </option>
            @endforeach
        </select>
    </div>

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

