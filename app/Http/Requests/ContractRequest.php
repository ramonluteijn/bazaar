<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContractRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|max:65535',
            'signed_at' => 'required|date',
            'status' => 'required|string|in:pending,signed,rejected',
            'contract' => 'nullable|file|mimes:pdf|max:2048',
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
            'title.required' => __('A title is required'),
            'description.required' => __('A description is required'),
            'signed_at.required' => __('A signed date is required'),
            'status.required' => __('A status is required'),
            'title.string' => __('Title must be a string'),
            'title.max' => __('Title is too long'),
            'description.max' => __('Description is too long'),
            'signed_at.date' => __('Signed date must be a valid date'),
            'status.string' => __('Status must be a string'),
            'status.in' => __('Status must be pending, signed, or rejected'),
            'contract.file' => __('Contract must be a file'),
            'contract.mimes' => __('Contract must be a pdf'),
            'contract.max' => __('Contract is too large'),
        ];
    }
}
