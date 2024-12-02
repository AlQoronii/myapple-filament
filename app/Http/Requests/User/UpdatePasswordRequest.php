<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
            "current_password" => [
                "required",
                "string"
            ],
            "new_password" => [
                "string",
                "required",
                "min:8"
            ]
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'new_password' => Hash::make($this->input('new_password'))
        ]);
    }

    function getData(): array
    {
        return [
            "current_password" => $this->input('current_password'),
            "new_password" => $this->input('new_password')
        ];
    }
}
