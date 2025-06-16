<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatalogRequest extends FormRequest
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
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls|max:10240',
            'status' => 'boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title_en.required' => 'The English title is required.',
            'title_ar.required' => 'The Arabic title is required.',
            'cover_image.image' => 'The uploaded cover must be an image.',
            'cover_image.mimes' => 'The cover image must be a file of type: jpeg, png, jpg, webp.',
            'cover_image.max' => 'The cover image size must not exceed 2MB.',
            'file.file' => 'The uploaded file is invalid.',
            'file.mimes' => 'The file must be a file of type: pdf, xlsx, xls.',
            'file.max' => 'The file size must not exceed 10MB.',
        ];
    }
}
