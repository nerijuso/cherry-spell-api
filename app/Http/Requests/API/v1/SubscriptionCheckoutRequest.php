<?php

namespace App\Http\Requests\API\v1;

use App\Models\FunnelPage;
use App\Models\Subscription\SubscriptionPlan;
use App\Services\Funnel\PageTypes\FunnelPagePlans;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->funnel->is_active ) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $funnelPlans = FunnelPage::where('funnel_id', $this->funnel->id)->where('type', class_to_snake(FunnelPagePlans::class))->first();
        $plansIds = SubscriptionPlan::whereIn('id', data_get($funnelPlans, 'data.subscription_plan_ids'))->get('ref_id')->pluck('ref_id')->transform(function ($item) {
            return transform_price_id_to_public($item);
        })->implode(',');

        return [
            'plan_id' => 'required|string|in:'.$plansIds,
            'session_id' => [
                'required',
                'string',
                ! Rule::unique('leads')->where(function (Builder $query) {
                    return $query
                        ->where('funnel_id', $this->funnel->id)
                        ->where('session_id', $this->session_id);
                }),
            ],
        ];
    }
}
