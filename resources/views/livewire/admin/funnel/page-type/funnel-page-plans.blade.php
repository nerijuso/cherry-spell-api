<div class="col-lg-12">
    <div class="mb-3">
        <label class="form-label" for="subscriptionPlan">Subscription Plans</label>
        <select multiple class="form-select" name="subscriptionPlan" id="subscriptionPlan"  wire:model="selectedSubscriptionPlans">
            <option>Select</option>
            @foreach ($subscriptionPlans as $item)
                <option @if(in_array($item->id, $selectedSubscriptionPlans)) selected @endif  value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>
