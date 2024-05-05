<?php

namespace App\Http\Requests\API\v1;

use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionCheckoutValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $lead = Lead::where('session_id', $this->session_id)->exists();

        if ($lead && $lead->funnel->is_active) {
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
        return [
        ];
    }
}
