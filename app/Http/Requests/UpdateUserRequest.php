<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'string',
                // 'unique:users,email'
            ],
            'user_meta' => 'sometimes|array',
            'user_meta.industry' => 'sometimes|string|nullable',
            'user_meta.city' => 'sometimes|string|nullable',
            'user_meta.region' => 'sometimes|string|nullable',
            'user_meta.country' => 'sometimes|string|nullable'
        ];
    }

    public function getUserMeta()
    {
        return $this->input('user_meta', []);
    }
}
