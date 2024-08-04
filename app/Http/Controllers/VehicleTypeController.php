<?php

namespace App\Http\Controllers;

use App\Http\Resources\StandardResource;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle_types = VehicleType::with(['vehicles'])->get();

        return StandardResource::collection($vehicle_types);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicleType = VehicleType::create([
            ...$request->validate(['name' => 'required|unique:vehicle_types,name'])
        ]);

        return new StandardResource($vehicleType );
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleType $vehicleType)
    {
        $vehicleType->load(['vehicles', 'vehicles.vehicleStatus']);

        return new StandardResource($vehicleType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        $vehicleType->update([
            ...$request->validate(['name' => 'sometimes|unique:vehicle_types,name'])
        ]);

        return new StandardResource($vehicleType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        return response()->noContent();
    }
}
