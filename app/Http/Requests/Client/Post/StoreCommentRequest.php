<?php

namespace App\Http\Requests\Client\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' =>'required|string',
            'parent_id' =>'nullable|integer',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
           'profile_id'=> auth()->user()->profile->id
        ]);
    }
}
