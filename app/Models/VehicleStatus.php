<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleStatus extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'vehicle_statuses';

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
