<?php

namespace App\Http\Requests\Api\Post;

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
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'published_at_from' => 'nullable|date_format:Y-m-d H:i',
            'published_at_to' => 'nullable|date_format:Y-m-d H:i',
            'profile_id' => 'nullable|integer|exists:profiles,id',
            'is_published' => 'nullable|boolean',
        ];
    }

}
