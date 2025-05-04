<?php

namespace App\Http\Requests\Api\Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'description' => 'nullable|string',
            'profile_id' => 'required|integer',
            'video_path' => 'nullable|string|unique:videos,video_path',
        ];
    }
}
