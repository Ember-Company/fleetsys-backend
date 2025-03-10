<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleAssignmentRequest;
use App\Http\Requests\UpdateVehicleAssignmentRequest;
use App\Http\Resources\VehicleAssignment as ResourcesVehicleAssignment;
use App\Models\AssignmentHistory;
use App\Models\VehicleAssignment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VehicleAssignmentController extends Controller
{

    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(VehicleAssignment::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = VehicleAssignment::all();

        return new ResourcesVehicleAssignment($assignments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleAssignmentRequest $request)
    {
        $data = $request->validated();
        VehicleAssignment::create($data);
        return new ResourcesVehicleAssignment($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleAssignment $vehicleAssignment)
    {
        return new ResourcesVehicleAssignment($vehicleAssignment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleAssignmentRequest $request, VehicleAssignment $vehicleAssignment)
    {
        $data = $request->validated();

        if ($vehicleAssignment->user_id !== $data['user_id']) {
            AssignmentHistory::create([
                'vehicle_id' => $vehicleAssignment->vehicle_id,
                'user_id' => $vehicleAssignment->user_id,
                'action' => 'ASSIGNED',
            ]);
        }

        $vehicleAssignment->update($data);

        return new ResourcesVehicleAssignment($vehicleAssignment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleAssignment $vehicleAssignment)
    {
        $vehicleAssignment->delete();

        AssignmentHistory::create([
            'vehicle_id' => $vehicleAssignment->vehicle_id,
            'user_id' => $vehicleAssignment->user_id,
            'action' => 'REMOVED',
        ]);

        return response()->json(['message' => 'Assignment removed successfully'], 200);
    }
}
