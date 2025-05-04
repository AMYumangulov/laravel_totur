<?php

namespace App\Http\Requests\Api\User;

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
                'name' => 'nullable|string',
                'email' => 'required|string|unique:users,email,'. $this->user->id,
                'email_verified_at' => 'nullable|date_format:Y-m-d',
                'password' => 'nullable|string',
                'remember_token' => 'nullable|string',
        ];
    }
}
