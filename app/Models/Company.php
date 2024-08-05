<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'companies';

    protected $fillable = ['name', 'created_at'];

    protected $casts = ['id' => 'string'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function vehicleTypes(): HasMany
    {
        return $this->hasMany(VehicleType::class);
    }

    public function vehicleStatuses(): HasMany
    {
        return $this->hasMany(VehicleStatus::class);
    }
}
