<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrentLocationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('companies', CompanyController::class);
    Route::resource('fuel', FuelController::class)->except('edit','create');
    Route::resource('location', CurrentLocationController::class)->only('store', 'show');
    Route::resource('driver', DriverController::class)->except('edit', 'create');
});

