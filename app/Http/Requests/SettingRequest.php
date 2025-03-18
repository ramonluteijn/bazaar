<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasRole('owner') || Auth::user()->hasRole('admin');
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
            'name.required' => __('Name is required'),
            'name.string' => __('Name must be a string'),
            'name.max' => __('Name must not be greater than 255 characters'),
            'percentage.required' => __('Percentage is required'),
            'percentage.numeric' => __('Percentage must be a number'),
            'percentage.between' => __('Percentage must be between 0 and 100')
        ];
    }
}
