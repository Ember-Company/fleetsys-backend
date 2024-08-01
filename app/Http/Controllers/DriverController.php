<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use Exception;

class DriverController extends Controller
{
    
    public function index()
    {
        try{
            $drivers = Driver::all();
        
            return response()->json(['data' => $drivers], 200); 
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500); 
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
     {
        try{
            $data = $request->validated(); 
            Driver::create($data);

            return response()->json(['success' => 'Driver successfully created'], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        try{
            return response()->json(['data' => $driver ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        try{
            $data = $request->validated();
            $driver->update($data);
            
            return response()->json(['success' => 'Driver data successfully updated'], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
        
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        try{
            $driver->delete();
            return response()->json(['success' => "Driver " . $driver->name." successfully removed" ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
