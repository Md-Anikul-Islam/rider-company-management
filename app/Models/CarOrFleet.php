<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOrFleet extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_type_id',
        'car_image',
        'plate_no',
        'car_name',
        'car_model',
        'car_make',
        'year',
        'car_color',
        'car_base',
        'passengers',
        'car_bag',
        'car_register_card',
        'status',
    ];

    public function fleetType()
    {
        return $this->belongsTo(FleetType::class, 'car_type_id');
    }
}
