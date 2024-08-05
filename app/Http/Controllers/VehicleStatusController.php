<?php

namespace App\Http\Controllers;

use App\Http\Resources\StandardResource;
use App\Models\VehicleStatus;
use App\Traits\ValidatesUniques;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class VehicleStatusController extends Controller
{
    use AuthorizesRequests, ValidatesUniques;

    public function __construct()
    {
        $this->authorizeResource(VehicleStatus::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicleStatuses = VehicleStatus::with(['vehicles', 'vehicles.vehicleType'])->whereBelongsTo($request->user()->company)->get()->sortDesc();

        return StandardResource::collection($vehicleStatuses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = $request->user()->company;

        $vehicleStatus = $company->vehicleStatuses()->create([
            ...$request->validate([
                'status_color' => 'required|string|max:7',
                'name' => [
                    'required',
                    $this->uniqueWithCompany('vehicle_statuses', 'name', $company)
                ],
            ]),
        ]);

        return new StandardResource($vehicleStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleStatus $vehicleStatus)
    {
        $vehicleStatus->load(['vehicles', 'vehicles.vehicleType']);

        return new StandardResource($vehicleStatus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleStatus $vehicleStatus)
    {
        $company = $request->user()->company;

        $updatedVehicleStatus = $vehicleStatus->update([
            ...$request->validate([
                'status_color' => 'sometimes|max:7',
                'name' => [
                    'sometimes',
                    $this->uniqueWithCompany('vehicle_statuses', 'name', $company)
                ]
            ])
        ]);

        return new StandardResource($updatedVehicleStatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleStatus $vehicleStatus)
    {
        $vehicleStatus->delete();

        return response()->noContent();
    }
}
