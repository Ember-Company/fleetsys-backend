<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => ['sometimes', Rule::in(array_column(UserRole::cases(), 'value'))],

            // User profile
            'user_meta' => 'required|array',
            'user_meta.industry' => 'nullable|string',
            'user_meta.city' => 'nullable|string',
            'user_meta.region' => 'nullable|string',
            'user_meta.country' => 'nullable|string'
        ];
    }
}
