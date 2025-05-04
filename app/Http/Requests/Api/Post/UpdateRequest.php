<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'nullable|string',
            'profile_id' => 'required|integer',
            'is_published' => 'nullable|boolean',
            'category_id' => 'required|integer',
            'image_path' => 'nullable|string|unique:posts,image_path,'. $this->post->id,
            'views' => 'nullable|integer',
            'published_at' => 'nullable|date_format:Y-m-d',

        ];
    }
}
