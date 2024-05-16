<?php

namespace App\Http\Requests\API\v1;

use App\Models\Lead;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    protected ?Lead $lead;

    public function authorize(): bool
    {
        $this->lead = Lead::where('session_id', $this->session_id)->first();

        if (! is_null($this->lead) && $this->lead->funnel->is_active) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:rfc',
                Rule::unique('users')->where(function (Builder $query) {
                    return $query
                        ->where('email', $this->email)
                        ->whereNot('id', $this->lead->user_id);
                }),
            ],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()],
            'checkout_session_id' => 'required',
            'session_id' => 'required',
        ];
    }
}
