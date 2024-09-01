<?php

namespace App\Models;

use App\Enums\FuelType;
use App\Enums\FuelVolumeUnit;
use App\Enums\MeasurementSystem;
use App\Enums\MeterUnit;
use App\Enums\VehicleOwnership;
use App\Observers\VehicleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([VehicleObserver::class])]
class Vehicle extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'vehicles';

    protected $fillable = [
        'name',
        'company_id',
        'vehicle_type_id',
        'vehicle_status_id',
        'fuel_type',
        'ownership',
        'color',
        'license_plate',
        'vin',
        'year',
        'make',
        'model'
    ];

    protected $hidden = [
        'loan_account_number',
        'loan_vendor_id',
        'loan_interest_rate'
    ];

    protected $casts = [
        'id' => 'string',
        'fuel_volume_unit' => FuelVolumeUnit::class,
        'fuel_type' => FuelType::class,
        'system_of_measurement' => MeasurementSystem::class,
        'primary_meter_unit' => MeterUnit::class,
        'ownership' => VehicleOwnership::class
    ];

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function vehicleStatus(): BelongsTo
    {
        return $this->belongsTo(VehicleStatus::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function vehicleAssignments()
    {
        return $this->hasMany(VehicleAssignment::class);
    }
}
