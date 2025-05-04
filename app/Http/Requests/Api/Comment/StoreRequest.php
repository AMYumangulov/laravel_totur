<?php

namespace App\Http\Requests\Api\Comment;

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
            'post_id' => 'required|integer',
            'content' => 'required|string',
            'profile_id' => 'required|integer',
            'status' => 'nullable|string',
            'parent_id' => 'nullable|integer'
        ];
    }
}



