<?php

namespace App\Http\Requests\Api\Profile;

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
        return ['name' => 'nullable|string',
                'user_id' => 'required|integer',
                'phone'=>'nullable|string',
                'address'=>'nullable|string',
                'gender'=>'nullable|string',
        ];
    }
}



