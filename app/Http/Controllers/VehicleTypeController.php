<?php

namespace App\Http\Controllers;

use App\Http\Resources\StandardResource;
use App\Models\VehicleType;
use App\Traits\ValidatesUniques;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{

    use AuthorizesRequests, ValidatesUniques;

    public function __construct()
    {
        return $this->authorizeResource(VehicleType::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $company = $request->user()->company;
        $vehicle_types = VehicleType::with(['vehicles', 'attributes'])->whereBelongsTo($company)->get()->sortDesc();
        // $vehicle_types = VehicleType::with(['vehicles'])->get();

        return StandardResource::collection($vehicle_types);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = $request->user()->company;

        $vehicleType = $company->vehicleTypes()->create([
            ...$request->validate([
                'name' => [
                    'required',
                    $this->uniqueWithCompany('vehicle_types', 'name')
                ],
            ]),
        ]);

        return new StandardResource($vehicleType);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, VehicleType $vehicleType)
    {
        $vehicleType->load(['vehicles', 'vehicles.vehicleStatus', 'attributes']);

        return new StandardResource($vehicleType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        $vehicleType->update([
            ...$request->validate([
                'name' => [
                    'sometimes',
                    $this->uniqueWithCompany('vehicle_types', 'name')
                ]
            ])
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
