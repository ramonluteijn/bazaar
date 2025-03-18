<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'email.required' => __('Email is required'),
            'email.email' => __('Email must be a valid email address'),
            'email.max' => __('Email must not be greater than 255 characters'),
            'title.string' => __('Title must be a string'),
            'title.max' => __('Title must not be greater than 255 characters'),
            'title.required' => __('Title is required'),
            'image.required' => __('Image is required'),
            'image.image' => __('Image must be an image'),
            'image.mimes' => __('Image must be a file of type: jpeg, png, jpg, gif, svg'),
            'image.max' => __('Image must not be greater than 2048 kilobytes'),
        ];
    }
}
