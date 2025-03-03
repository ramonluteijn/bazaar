<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|max:65535',
            'percentage' => 'required|numeric|between:0,100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'description.required' => 'Description is required',
            'description.max' => 'Description must not be greater than 65535 characters',
            'percentage.required' => 'Percentage is required',
            'percentage.numeric' => 'Percentage must be a number',
            'percentage.between' => 'Percentage must be between 0 and 100'
        ];
    }
}
