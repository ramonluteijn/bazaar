<?php

namespace App\Http\Requests;

use App\Rules\MaxAmountOfAdvertisementsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0|max:2147483647',
            'description' => 'nullable|max:65535',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => ['required', new MaxAmountOfAdvertisementsRule()],
            'expires_at' => 'date|after:today',
            'collection_date' => 'nullable|date|after:today',
            'return_date' => 'nullable|date|after:collection_date',
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
            'title.required' => __('Title is required'),
            'title.max' => __('Title is too long'),
            'price.required' => __('Price is required'),
            'price.numeric' => __('Price must be a number'),
            'price.min' => __('Price must be at least 0'),
            'price.max' => __('Price is too high'),
            'description.max' => __('Description is too long'),
            'image.image' => __('Image must be an image'),
            'image.mimes' => __('Image must be a jpeg, png, jpg, gif, or svg'),
            'image.max' => __('Image is too large'),
            'type.required' => __('Type is required'),
            'expires_at.date' => __('Expires at must be a date'),
            'expires_at.after' => __('Expires at must be after today'),
            'collection_date.date' => __('Collection date must be a date'),
            'collection_date.after' => __('Collection date must be after today'),
            'return_date.date' => __('Return date must be a date'),
            'return_date.after' => __('Return date must be after collection date'),
        ];
    }
}
