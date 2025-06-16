<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSideBannerRequest extends FormRequest
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
            'subtitle_en' => 'required|string|max:255',
            'subtitle_ar' => 'required|string|max:255',
            'button_text_en' => 'required|string|max:255',
            'button_text_ar' => 'required|string|max:255',
            'button_link' => 'nullable|string|max:255|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'boolean',
            'position' => 'required|integer|min:1|max:2'
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
            'subtitle_en.required' => 'The English subtitle is required.',
            'subtitle_ar.required' => 'The Arabic subtitle is required.',
            'button_text_en.required' => 'The English button text is required.',
            'button_text_ar.required' => 'The Arabic button text is required.',
            'button_link.url' => 'The button link must be a valid URL.',
            'image.required' => 'Please upload an image for the banner.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'image.max' => 'The image size must not exceed 2MB.',
            'position.required' => 'Please select a position for the banner.',
            'position.min' => 'Invalid position value.',
            'position.max' => 'Invalid position value.'
        ];
    }
}
