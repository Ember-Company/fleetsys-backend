<?php

namespace App\Http\Requests;

use App\Enums\FuelType;
use App\Enums\VehicleOwnership;
use App\Rules\ValidYear;
use App\Traits\ValidatesUniques;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreVehicleRequest extends FormRequest
{
    // use ValidatesUniques;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                $this->uniqueWithCompany('vehicles', 'name')
            ],
            'vehicle_type_id' => 'required|uuid|exists:vehicle_types,id',
            'vehicle_status_id' => 'required|uuid|exists:vehicle_statuses,id',
            'fuel_type' => [
                'sometimes',
                new Enum(FuelType::class)
            ],
            'ownership' => [
                'sometimes',
                new Enum(VehicleOwnership::class)
            ],
            'color' => 'sometimes|string|max:7',
            'license_plate' => 'sometimes|string',
            'vin' => 'sometimes|string|max:17',
            'year' => [
                'sometimes',
                new ValidYear()
            ],
            'make' => 'sometimes|string',
            'model' => 'sometimes|string'
        ];
    }
}
