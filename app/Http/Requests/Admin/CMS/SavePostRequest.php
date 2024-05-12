<?php

namespace App\Http\Requests\Admin\CMS;

use App\Models\CMS\Post;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SavePostRequest extends FormRequest
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
        $images = [];

        foreach ((new Post())->imageSizes as $size) {
            $images[$size] = 'sometimes|file|image';
        }

        return array_merge([
            'title' => ['required', 'min:1', 'max:255', Rule::unique('posts')->where(function (Builder $query) {
                $query->where('slug', Str::slug($this->title));

                if (isset($this->post) && ! is_null($this->post->id)) {
                    $query->where('id', '!=', $this->post->id);
                }

                return $query;
            })],
            'text' => 'required|string',
            'position' => 'required|integer',
            'is_active' => 'boolean',
        ], $images);
    }
}
