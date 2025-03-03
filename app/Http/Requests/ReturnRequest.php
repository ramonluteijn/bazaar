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
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not be greater than 255 characters',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must not be greater than 255 characters',
            'title.required' => 'Title is required',
            'image.required' => 'Image is required',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
            'image.max' => 'Image must not be greater than 2048 kilobytes',
        ];
    }
}
