<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Vehicle;
use App\Traits\ValidateRoles;
use App\Traits\VehicleAssignmentValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleAssignmentRequest extends FormRequest
{

    use ValidateRoles, VehicleAssignmentValidation;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function authorize(): bool
    {
        $vehicle = Vehicle::findOrFail($this->vehicle_id);
        $user = User::findOrFail($this->user_id);

        if (!$this->assign($user, $vehicle)) {
            abort(403);
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'started_at' => ['required', 'date', 'before_or_equal:ended_at'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'starting_meter_entry' => ['nullable', 'string', 'max:255'],               
            'ending_meter_entry' => ['nullable', 'string', 'max:255'],
            'comments' => ['nullable', 'string'],
            'user_id' => ['required', $this->notAdminUserRule()],                       
            'vehicle_id' => ['required','exists:vehicles,id'],                     
        ];
    }
}
