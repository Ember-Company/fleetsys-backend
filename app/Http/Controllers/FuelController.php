<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuelRequest;
use App\Http\Requests\UpdateFuelRequest;
use App\Models\Fuel;
use Exception;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $fuel = Fuel::all();
            return response()->json(['data' => $fuel], 200); 
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500); 
        }
    }

    public function show(Fuel $fuel)
    {
        try{
            return response()->json(['data' => $fuel ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuelRequest $request)
    {
        try{
            $data = $request->validated(); 
            Fuel::create($data);

            return response()->json(['success' => 'Fuel successfully created'], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        try{
            $data = $request->validated();
            $fuel->update($data);
            
            return response()->json(['success' => 'Fuel data successfully updated' ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel $fuel)
    {
        try{
            $fuel->delete();
            return response()->json(['success' => "Fuel ". $fuel->name." successfully removed" ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
