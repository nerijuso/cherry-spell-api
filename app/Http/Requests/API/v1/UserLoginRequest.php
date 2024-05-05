<?php

namespace App\Http\Requests\API\v1;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function rules()
    {
        $this->email = strtolower($this->email);

        return [
            'email' => 'required|max:100|string|email:rfc,filter|exists:'.User::class.',email',
            'password' => 'required|string',
        ];
    }
}
