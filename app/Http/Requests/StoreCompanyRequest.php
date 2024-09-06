<?php

namespace App\Http\Requests;

use App\Enums\SubscriptionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'industry' => 'string|nullable',
            'active' => 'sometimes|boolean',
            'subscription_type' => ['sometimes', new Enum(SubscriptionType::class)],
            'max_vehicles' => 'sometimes|integer|min:0',
            'contact_name' => 'sometimes|string|nullable',
            'contact_email' => 'sometimes|email|nullable',
            'contact_phone' => 'sometimes|string|nullable',
            'country' => 'sometimes|string|nullable',
            'state' => 'sometimes|string|nullable',
            'city' => 'sometimes|string|nullable',
            'max_drivers' => 'sometimes|integer|min:0',
            'max_routes' => 'sometimes|integer|min:0',
            'has_support_access' => 'sometimes|boolean',
        ];
    }
}
