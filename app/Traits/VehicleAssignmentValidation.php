<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Vehicle;

trait VehicleAssignmentValidation
{
    public function canAssignDriver(Vehicle $vehicle): bool
    {
        return $vehicle->vehicleStatus->name === 'Available';
    }

    public function canAssignTechnician(Vehicle $vehicle): bool
    {
       return $vehicle->vehicleStatus->name === 'Needs Maintenance';
    }

    public function assign(User $user, Vehicle $vehicle): bool
    {
        if ($user->role->value === 'DRIVER') {
            return $this->canAssignDriver($vehicle);
        }

        if ($user->role->value === 'TECHNICIAN') {
            return $this->canAssignTechnician($vehicle);
        }

        return false;
    }
    
}
