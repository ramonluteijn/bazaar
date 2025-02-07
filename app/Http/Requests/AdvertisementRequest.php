<?php

namespace App\Http\Requests;

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
            'type' => 'required|in:sale,hire',
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
            'title.required' => 'Title is required',
            'title.max' => 'Title is too long',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price must be at least 0',
            'price.max' => 'Price is too high',
            'description.max' => 'Description is too long',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be a jpeg, png, jpg, gif, or svg',
            'image.max' => 'Image is too large',
            'type.required' => 'Type is required',
            'type.in' => 'Type must be sale or hire',
        ];
    }
}
