<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'qty' => 'required|numeric|min:0',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'tax' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable',
            'trend' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // تحقق من صحة صيغ الصور
            'slug' => 'required|string|unique:products,slug',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'required|string|max:255',
        ];
    }
}
