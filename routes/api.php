<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrentLocationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleAssignmentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleStatusController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Resources\StandardResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $user = $request->user();
    $user->load(['profile']);

    return new StandardResource($user);
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:web');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->except('store');
    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('vehicle-types', VehicleTypeController::class);
    Route::apiResource('vehicles', VehicleController::class);
    Route::apiResource('vehicle-status', VehicleStatusController::class);
    Route::apiResource('vehicle-assignments', VehicleAssignmentController::class);
    Route::resource('fuel', FuelController::class)->except('edit', 'create');
    Route::resource('location', CurrentLocationController::class)->only('store', 'show');
    Route::resource('driver', DriverController::class)->except('edit', 'create');
    Route::apiResource('attributes', AttributeController::class);
});
