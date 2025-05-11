<?php

namespace App\Http\Requests\Client\Post;

use Illuminate\Foundation\Http\FormRequest;

class RepostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>'required|string',
            'content' =>'nullable|string',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
           'profile_id'=> auth()->user()->profile->id,
            'category_id' => $this->post->category_id,
        ]);
    }
}
