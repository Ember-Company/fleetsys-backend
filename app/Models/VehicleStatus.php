<?php

namespace App\Models;

use App\Enums\StatusColors;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleStatus extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'vehicle_statuses';

    protected $fillable = [
        'name',
        'status_color',
        'company_id',
        'is_default'
    ];

    protected $casts = [
        'status_color' => StatusColors::class
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
