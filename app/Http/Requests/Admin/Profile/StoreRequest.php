<?php

namespace App\Http\Requests\Admin\Profile;

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
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string',
        ];
    }
}
