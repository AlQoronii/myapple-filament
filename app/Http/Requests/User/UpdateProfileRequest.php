<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                'string',
                'min:3',
                'max:255'
            ],
            "email" => [
                'string',
                'email',
                'max:255',
                'unique:users,email,' . auth()->user()->id
            ],
            "picture" => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg,gif,svg',
            'max:2048'
        ]
        ];
    }

    function getData(): array
    {
        return [
            "name" => $this->input('name'),
            "email" => $this->input('email')
        ];
    }
}
