<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            'post.title' => 'required|string',
            'post.content' => 'nullable|string',
            'post.category_id' => 'required|integer|exists:categories,id',
            'post.published_at' => 'required|date_format:Y-m-d H:i',
            'tags' => 'nullable|string',
            'image' => 'nullable|file'
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
                'post' => [
                    ...$this->validated()['post'],
                    'profile_id' => auth()->user()->profile->id,
                ],
                'image_path' => $this->image ? Storage::disk('public')->put('/images', $this->image) : null,
                'tag_titles' => $this->tags ?  explode(',', $this->tags): []
            ]
        );
    }
}
