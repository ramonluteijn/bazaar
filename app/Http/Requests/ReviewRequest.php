<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'content' => 'required|max:65535',
            'rating' => 'required|integer|min:1|max:10',
            'advertisement_id' => 'nullable|integer',
            'user_id' => 'nullable|integer',
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
            'title.required' => __('Title is required'),
            'title.string' => __('Title must be a string'),
            'title.max' => __('Title must not be greater than 255 characters'),
            'content.required' => __('Content is required'),
            'content.max' => __('Content must not be greater than 65535 characters'),
            'rating.required' => __('Rating is required'),
            'rating.integer' => __('Rating must be an integer'),
            'rating.min' => __('Rating must be at least 1'),
            'rating.max' => __('Rating must not be greater than 10'),
        ];
    }
}
