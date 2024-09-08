<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidatesUniques;
class StoreVehicleTypeRequest extends FormRequest
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
            'name' =>  ['required', $this->uniqueWithCompany('vehicle_types', 'name')],
            'attributes' => 'array'
        ];
    }
}
