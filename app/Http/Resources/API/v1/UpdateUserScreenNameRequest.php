<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserScreenNameRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'screen_name' => 'required|min:3|max:32',
        ];
    }

    public function messages(): array
    {
        return [
            'screen_name.required' => trans('validation.user.name.required'),
            'screen_name.min' => trans('validation.user.name.min'),
            'screen_name.max' => trans('validation.user.name.max'),
        ];
    }
}
