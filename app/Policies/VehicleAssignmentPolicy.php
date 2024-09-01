<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Roles;
use App\Models\User;
use App\Models\VehicleAssignment;
use Illuminate\Auth\Access\Response;

class VehicleAssignmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isMaster();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VehicleAssignment $vehicleAssignment): bool
    {
        return $user->isAdmin() || $user->isMaster() || $user->isDriver() && $vehicleAssignment->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isMaster();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VehicleAssignment $vehicleAssignment): bool
    {
        return $user->isAdmin() || $user->isMaster();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VehicleAssignment $vehicleAssignment): bool
    {
        return $user->isAdmin() || $user->isMaster();
    }
}
