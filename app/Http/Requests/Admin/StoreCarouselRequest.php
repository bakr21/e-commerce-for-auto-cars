<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarouselRequest extends FormRequest
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
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'button_text_en' => 'required|string|max:255',
            'button_text_ar' => 'required|string|max:255',
            'button_link' => 'nullable|string|max:255|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'boolean',
            'sort_order' => 'integer'
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
            'description_en.required' => 'The English description is required.',
            'description_ar.required' => 'The Arabic description is required.',
            'button_text_en.required' => 'The English button text is required.',
            'button_text_ar.required' => 'The Arabic button text is required.',
            'button_link.url' => 'The button link must be a valid URL.',
            'image.required' => 'Please upload an image for the carousel.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}
