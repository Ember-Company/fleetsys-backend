<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Vehicle;

trait VehicleAssignmentValidation
{
    public function canAssignDriver(Vehicle $vehicle): bool
    {
        return $vehicle->status === 'Available';
    }

    public function canAssignTechnician(Vehicle $vehicle): bool
    {
       return $vehicle->status === 'In Repair';
    }

    public function assign(User $user, Vehicle $vehicle)
    {
        if ($user->role === 'Driver') {
            return $this->canAssignDriver($vehicle);
        }

        if ($user->role === 'Technician') {
            return $this->canAssignTechnician($vehicle);
        }

        return false;
    }
    
}
