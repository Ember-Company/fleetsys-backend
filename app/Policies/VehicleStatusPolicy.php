<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VehicleStatus;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class VehicleStatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VehicleStatus $vehicleStatus): bool
    {
        return Gate::allows('is-company-member', $vehicleStatus->company);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VehicleStatus $vehicleStatus): bool
    {
        return Gate::allows('is-company-member', $vehicleStatus->company);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VehicleStatus $vehicleStatus): bool
    {
        return Gate::allows('is-company-member', $vehicleStatus->company);
    }
}
