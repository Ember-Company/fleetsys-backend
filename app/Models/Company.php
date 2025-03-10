<?php

namespace App\Models;

use App\Enums\SubscriptionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'companies';

    protected $fillable = ['name', 'industry', 'active', 'subscription_type', 'last_active_at', 'max_vehicles', 'contact_name', 'contact_email', 'contact_phone', 'country', 'state', 'city', 'max_drivers', 'max_routes', 'has_support_access'];

    protected $casts = ['id' => 'string', 'active' => 'boolean', 'subscription_type' => SubscriptionType::class, 'last_active_at' => 'datetime'];

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
