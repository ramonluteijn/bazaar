<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'address' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'zip' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'comment' => 'nullable|max:65535',
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
            'name.required' => __('A name is required'),
            'address.required' => __('An address is required'),
            'delivery_address.required' => __('A delivery address is required'),
            'phone.required' => __('A phone number is required'),
            'email.required' => __('An email is required'),
            'zip.required' => __('A zip code is required'),
            'city.required' => __('A city is required'),
            'state.required' => __('A state is required'),
            'country.required' => __('A country is required'),
            'total.required' => __('A total amount is required'),
            'status.required' => __('A status is required'),
            'name.string' => __('Name must be a string'),
            'address.string' => __('Address must be a string'),
            'delivery_address.string' => __('Delivery address must be a string'),
            'phone.string' => __('Phone number must be a string'),
            'email.email' => __('Email must be a valid email address'),
            'zip.string' => __('Zip code must be a string'),
            'city.string' => __('City must be a string'),
            'state.string' => __('State must be a string'),
            'country.string' => __('Country must be a string'),
        ];
    }
}
