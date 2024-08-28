<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Vehicle::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $company = $request->user()->company;

        $vehicles = Vehicle::with(['vehicleType', 'vehicleStatus'])
            ->whereBelongsTo($company)
            ->latest()
            ->paginate(10);

        return VehicleResource::collection($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $company = $request->user()->company;

        $vehicle = $company->vehicles()->create([
            ...$request->validated(),
        ]);

        $vehicle->load(['vehicleType', 'vehicleStatus']);
        return new VehicleResource($vehicle);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['vehicleType', 'vehicleStatus']);

        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update([
            ...$request->validated()
        ]);

        $vehicle->load(['vehicleType', 'vehicleStatus']);

        return new VehicleResource($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->noContent();
    }
}
