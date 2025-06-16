<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class SaveRatingRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:500'
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
            'product_id.required' => 'Product ID is required.',
            'product_id.exists' => 'The selected product does not exist.',
            'rating.required' => 'Rating is required.',
            'rating.integer' => 'Rating must be a number.',
            'rating.min' => 'Rating must be at least 1.',
            'rating.max' => 'Rating cannot be more than 5.',
            'comment.required' => 'Please provide a review comment.',
            'comment.min' => 'Your comment must be at least 10 characters long.',
            'comment.max' => 'Your comment cannot exceed 500 characters.'
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
            'message' => 'You must be logged in to submit a review.'
        ], 401);
    }
}
