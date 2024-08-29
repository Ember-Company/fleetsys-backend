<?php

namespace App\Observers;

use App\Models\Vehicle;

class VehicleObserver
{
    /**
     * Handle the Vehicle "created" event.
     */
    public function created(Vehicle $vehicle): void
    {
        $companyQuery = $vehicle->company()->getQuery();
        $vehicleStatusQuery = $vehicle->vehicleStatus()->getQuery();
        $vehicleTypeQuery = $vehicle->vehicleType()->getQuery();

        // Update the counter on creation
        $companyQuery->increment('vehicles_count');
        $vehicleStatusQuery->increment('vehicles_count');
        $vehicleTypeQuery->increment('vehicles_count');
    }

    /**
     * Handle the Vehicle "updated" event.
     */
    public function updated(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "deleted" event.
     */
    public function deleted(Vehicle $vehicle): void
    {
        $companyQuery = $vehicle->company()->getQuery();
        $vehicleStatusQuery = $vehicle->vehicleStatus()->getQuery();
        $vehicleTypeQuery = $vehicle->vehicleType()->getQuery();

        $companyQuery->decrement('vehicles_count');
        $vehicleStatusQuery->increment('vehicles_count');
        $vehicleTypeQuery->increment('vehicles_count');
    }

    /**
     * Handle the Vehicle "restored" event.
     */
    public function restored(Vehicle $vehicle): void
    {
        //
    }

    /**
     * Handle the Vehicle "force deleted" event.
     */
    public function forceDeleted(Vehicle $vehicle): void
    {
        //
    }
}
