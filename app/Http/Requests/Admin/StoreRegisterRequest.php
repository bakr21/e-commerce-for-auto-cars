<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email',
            'password'   => 'required|min:7|confirmed',
            'address'    => 'required',
            'region'     => 'required',
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
            'name.required' => 'The full name is required.',
            'email.required' => 'Please provide your email.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'address.required' => 'The address is required.',
            'region.required' => 'Please select a region.',
        ];
    }
}
