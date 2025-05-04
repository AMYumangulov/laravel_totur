<?php

namespace App\Http\Requests\Client\Comment;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
                'per_page' => $this->per_page ?? 5,
                'page' => $this->page ?? 1,
            ]
        );
    }
}
