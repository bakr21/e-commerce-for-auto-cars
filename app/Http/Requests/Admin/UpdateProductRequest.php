<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name.ar' => 'required|string',
            'name.en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'min_qty' => 'required|numeric|min:0',
            'qty' => 'required|numeric|min:0',
            'short_description.ar' => 'required|string|max:500',
            'short_description.en' => 'required|string|max:500',
            'description.ar' => 'required|string',
            'description.en' => 'required|string',
            'tax' => 'nullable|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable',
            'trend' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // تحقق من صحة صيغ الصور
            'slug' => 'required|string',
            'meta_title.ar' => 'required|string|max:255',
            'meta_title.en' => 'required|string|max:255',
            'meta_description.ar' => 'nullable|string',
            'meta_description.en' => 'nullable|string',
            'meta_keywords.ar' => 'required|string|max:255',
            'meta_keywords.en' => 'required|string|max:255',
        ];
    }
}
