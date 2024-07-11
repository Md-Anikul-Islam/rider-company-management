<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'fleet_make_id',
        'car_model_name',
        'car_base_fare',
        'car_passenger_capacity',
        'car_bag_capacity',
        'status',
    ];
    protected $casts = [
        'id' => 'integer',
        'car_or_fleet_make_id' => 'integer',
    ];

}
