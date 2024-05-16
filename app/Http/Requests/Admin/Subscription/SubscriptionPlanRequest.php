<?php

namespace App\Http\Requests\Admin\Subscription;

use App\Models\Enums\SubscriptionPlanHighlightedOption;
use App\Models\Enums\SubscriptionPlanPeriodType;
use App\Models\Enums\SubscriptionPlanType;
use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionPlanRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|max:255',
            'sort' => 'required|integer|min:0',
            'price' => 'required|decimal:2',
            'old_price' => 'sometimes|nullable|decimal:2',
            'configuration' => 'sometimes|nullable|json',
            'period' => [Rule::enum(SubscriptionPlanPeriodType::class)],
            'is_hidden' => 'boolean',
            'size_1x' => 'sometimes|file|image',
            'type' => [Rule::enum(SubscriptionPlanType::class)],
            'free_gift_id' => 'sometimes|nullable|in:'.SubscriptionPlan::where('type', SubscriptionPlanType::SUBSCRIPTION_GIFT)->get('ref_id')->pluck('ref_id')->implode(','),
            'highlighted_option' => ['sometimes', Rule::enum(SubscriptionPlanHighlightedOption::class)],
        ];
    }
}
