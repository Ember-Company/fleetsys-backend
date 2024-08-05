<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'profiles';

    protected $fillable = [
        'industry',
        'city',
        'region',
        'postal_code',
        'country',
        'currency',
        'is_24_hour_format',
        'street_address',
        'user_id'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
