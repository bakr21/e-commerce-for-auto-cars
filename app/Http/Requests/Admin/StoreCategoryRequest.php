<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        'name_en'       => 'required|string|max:255',
        'name_ar'       => 'required|string|max:255',
        'slug'          => 'required|string|max:255|unique:categories,slug',
        'description_en' => 'required|string',
        'description_ar' => 'required|string',
        'is_showing'    => 'nullable',
        'is_popular'    => 'nullable',
        'image'         => 'required|image|mimes:jpg,jpeg,png,gif',
        'meta_title_en' => 'required|string|max:255',
        'meta_title_ar' => 'required|string|max:255',
        'meta_description_en' => 'required|string|max:500',
        'meta_description_ar' => 'required|string|max:500',
        'meta_keywords_en' => 'required|string|max:255',
        'meta_keywords_ar' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name_en.required' => 'Category name in English is required.',
            'name_ar.required' => 'Category name in Arabic is required.',
            'description_en.required' => 'Category description in English is required.',
            'description_ar.required' => 'Category description in Arabic is required.',
            'meta_title_en.required' => 'Meta title in English is required.',
            'meta_title_ar.required' => 'Meta title in Arabic is required.',
            'meta_description_en.required' => 'Meta description in English is required.',
            'meta_description_ar.required' => 'Meta description in Arabic is required.',
            'meta_keywords_en.required' => 'Meta keywords in English is required.',
            'meta_keywords_ar.required' => 'Meta keywords in Arabic is required.',
        ];
    }
}
