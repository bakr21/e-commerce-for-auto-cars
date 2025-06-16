<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class ProcessCheckoutRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|min:15',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,card,stripe',
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
            'name.required' => 'Please enter your full name.',
            'name.min' => 'Your name must be at least 5 characters long.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'address.required' => 'Please enter your address.',
            'address.min' => 'Your address must be at least 15 characters long.',
            'country.required' => 'Please select your country.',
            'city.required' => 'Please enter your city.',
            'state.required' => 'Please enter your state/province.',
            'zip.required' => 'Please enter your ZIP/postal code.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Please select a valid payment method.'
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
            'message' => 'You must be logged in to complete checkout.',
            'status' => false,
        ], 401);
    }
}
