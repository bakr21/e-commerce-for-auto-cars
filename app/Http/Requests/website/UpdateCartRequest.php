<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'qty' => 'required|integer|min:1',
            'id' => 'required|integer|exists:products,id'
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
            'qty.required' => 'Quantity is required.',
            'qty.integer' => 'Quantity must be a number.',
            'qty.min' => 'Quantity must be at least 1.',
            'id.required' => 'Product ID is required.',
            'id.exists' => 'The selected product does not exist.'
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedAuthorization()
    {
        return response()->json([
            'success' => false,
            'message' => 'You must be logged in to update your cart.'
        ], 401);
    }
}
