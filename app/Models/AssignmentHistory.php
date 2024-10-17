<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentHistory extends Model
{
    use HasFactory;
    protected $table = 'assignments_history';
    protected $fillable = ['user_id', 'vehicle_id', 'action'];

}
