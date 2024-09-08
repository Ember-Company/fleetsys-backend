<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleTypeRequest;
use App\Http\Requests\UpdateVehicleTypeRequest; 
use App\Http\Resources\StandardResource;
use App\Models\Attribute;
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
    public function store(StoreVehicleTypeRequest $request)
    {
        $company = $request->user()->company;
    
        $data = $request->validated();
    
        $vehicleType = $company->vehicleTypes()->create([
            'name' => $data['name'],
        ]);
    
        $attributes = $data['attributes'] ?? [];
    
        foreach ($attributes as $attributeName) {
            $attribute = Attribute::firstOrCreate(['name' => $attributeName]);
    
            $vehicleType->attributes()->syncWithoutDetaching([$attribute->id]);
        }

        return new StandardResource($vehicleType->load('attributes'));
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

    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $data = $request->validated();

        if (isset($data['name'])) {
            $vehicleType->update(['name' => $data['name']]);
        }

        $attributes = collect($data['attributes'] ?? []);

        $attributeIds = $attributes->map(function ($attributeName) {
            $attribute = Attribute::firstOrCreate(['name' => $attributeName]);
            return $attribute->id;
        })->toArray();

        $vehicleType->attributes()->sync($attributeIds);

        return new StandardResource($vehicleType->load('attributes'));
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
