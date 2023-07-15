<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email,'.$this->id,
            'password' => 'required_without:id|string|min:6',
            "data" => "required|string",
            "image" => "required_without:id|mimes:jpg,png,jpeg,gif|max:2048"

        ];
    }
}
