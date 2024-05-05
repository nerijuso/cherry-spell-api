<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'photo' => 'required|mimes:png,jpg,jpeg',
        ];
    }
}
