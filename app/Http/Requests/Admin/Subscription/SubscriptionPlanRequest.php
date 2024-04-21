<?php

namespace App\Http\Requests\Admin\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPlanRequest extends FormRequest
{
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
            'sort' => 'required|integer|min:1',
            'price' => 'required|decimal:2',
            'old_price' => 'sometimes|decimal:2',
            'is_hidden' => 'boolean',
            'is_popular' => 'boolean',
        ];
    }
}
