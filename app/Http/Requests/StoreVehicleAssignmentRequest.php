<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleAssignmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'started_at' => ['required', 'date', 'before_or_equal:ended_at'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'starting_meter_entry' => ['nullable', 'string', 'max:255'],               
            'ending_meter_entry' => ['nullable', 'string', 'max:255'],
            'comments' => ['nullable', 'string'],
            'user_id' => ['required','exists:users,id'],                             
            'vehicle_id' => ['required','exists:vehicles,id'],                     
        ];
    }
}
