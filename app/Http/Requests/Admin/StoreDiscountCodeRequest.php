<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountCodeRequest extends FormRequest
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
            'code' => 'required|string|max:50|unique:discount_coupons,code',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'nullable|boolean',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'max_uses_user' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
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
            'code.required' => 'The coupon code is required.',
            'code.unique' => 'This coupon code is already in use.',
            'discount_type.required' => 'Please select a discount type.',
            'discount_type.in' => 'The discount type must be either fixed or percentage.',
            'discount_amount.required' => 'The discount amount is required.',
            'discount_amount.numeric' => 'The discount amount must be a number.',
            'discount_amount.min' => 'The discount amount must be at least 0.',
            'min_order_amount.numeric' => 'The minimum order amount must be a number.',
            'min_order_amount.min' => 'The minimum order amount must be at least 0.',
            'max_uses.integer' => 'The maximum uses must be a whole number.',
            'max_uses.min' => 'The maximum uses must be at least 1.',
            'max_uses_user.integer' => 'The maximum uses per user must be a whole number.',
            'max_uses_user.min' => 'The maximum uses per user must be at least 1.',
            'start_date.date' => 'The start date must be a valid date.',
            'start_date.after_or_equal' => 'The start date must be today or later.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.'
        ];
    }
}
