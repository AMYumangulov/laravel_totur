<?php

namespace App\Http\Requests\Client\Chat;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string'
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
            'profile_id' => auth()->user()->profile->id
        ]);
    }
}
