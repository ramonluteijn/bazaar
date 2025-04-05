<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'bid_amount' => 'required|numeric|min:0.01|max:2147483647',
            'advertisement_id' => 'required|integer|exists:advertisements,id',
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
            'bid_amount.required' => __('Bid amount is required'),
            'bid_amount.numeric' => __('Bid amount must be a number'),
            'bid_amount.min' => __('Bid amount must be at least 0.01'),
            'bid_amount.max' => __('Bid amount is too high'),
        ];
    }
}
