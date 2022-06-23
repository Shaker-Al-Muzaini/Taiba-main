<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable=[
        'vehicle_number',
        'licence_number',
        'chassis_number',
        'type',
        'color',
        'capacity',
        'production_date',
        'licence_expire_date',
        'insurance_expire_date',
    ];
}
