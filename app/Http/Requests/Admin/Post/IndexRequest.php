<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class IndexRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post.title' => 'nullable|string',
            'post.content' => 'nullable|string',
            'post.category_id' => 'nullable|integer|exists:categories,id',
            'post.published_at_from' => 'nullable|date_format:Y-m-d H:i',
            'post.published_at_to' => 'nullable|date_format:Y-m-d H:i',
            'post.profile_id' => 'nullable|integer|exists:profiles,id',
            'post.is_published' => 'nullable|boolean',
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
                'per_page' => $this->per_page ?? 5,
                'page' => $this->page ?? 1,
            ]
        );
    }
}
