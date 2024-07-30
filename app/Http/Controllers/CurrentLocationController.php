<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrentLocationRequest;
use App\Http\Requests\UpdateCurrentLocationRequest;
use App\Models\CurrentLocation;
use Exception;

class CurrentLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $fuel = CurrentLocation::all();
            return response()->json(['data' => $fuel], 200); 
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500); 
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrentLocationRequest $request)
    {
        try{
            $data = $request->validated();
            CurrentLocation::create($data);
    
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CurrentLocation $currentLocation)
    {
        try{
            return response()->json(['data' => $currentLocation ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
