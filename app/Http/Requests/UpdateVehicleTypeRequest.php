<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidatesUniques;

class UpdateVehicleTypeRequest extends FormRequest
{
    use ValidatesUniques;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  ['sometimes', $this->uniqueWithCompany('vehicle_types', 'name')],
            'attributes' => 'array'
        ];
    }
}
