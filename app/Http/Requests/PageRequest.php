<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasRole('business_advertiser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'url' => ['required', 'regex:/^\S*$/', Rule::unique('content_pages')->ignore($this->route('id'))],
            'header_font' => 'nullable',
            'body_font' => 'nullable',
            'primary_color' => 'nullable|hex_color',
            'secondary_color' => 'nullable|hex_color',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => __('The title is required.'),
            'url.required' => __('The URL is required.'),
            'url.regex' => __('The URL must not contain spaces.'),
            'url.unique' => __('The URL is already in use.'),
            'header_font.nullable' => __('The header font must be a valid font.'),
            'body_font.nullable' => __('The body font must be a valid font.'),
            'primary_color.nullable' => __('The primary color must be a valid hex color.'),
            'secondary_color.nullable' => __('The secondary color must be a valid hex color.'),
        ];
    }
}
