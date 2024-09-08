<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Resources\StandardResource;
use App\Models\Attribute;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::all();
        return StandardResource::collection($attributes->load('vehicleTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        Attribute::create($request->validated());

        return new StandardResource($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->validated());

        return new StandardResource($attribute->load('vehicleTypes'));
    }
}
