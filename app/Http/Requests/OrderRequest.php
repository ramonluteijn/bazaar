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
            'comment' => 'nullable|string|max:65535',
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
            'name.required' => 'A name is required',
            'address.required' => 'An address is required',
            'delivery_address.required' => 'A delivery address is required',
            'phone.required' => 'A phone number is required',
            'email.required' => 'An email is required',
            'zip.required' => 'A zip code is required',
            'city.required' => 'A city is required',
            'state.required' => 'A state is required',
            'country.required' => 'A country is required',
            'total.required' => 'A total amount is required',
            'status.required' => 'A status is required',
            'name.string' => 'Name must be a string',
            'address.string' => 'Address must be a string',
            'delivery_address.string' => 'Delivery address must be a string',
            'phone.string' => 'Phone number must be a string',
            'email.email' => 'Email must be a valid email address',
            'zip.string' => 'Zip code must be a string',
            'city.string' => 'City must be a string',
            'state.string' => 'State must be a string',
            'country.string' => 'Country must be a string',
            'comment.string' => 'Comment must be a string',
        ];
    }
}
