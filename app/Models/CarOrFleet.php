<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOrFleet extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'fleet_type_id',
        'fleet_make_id',
        'fleet_model_id',
        'car_image',
        'plate_no',
        'car_name',
        'year',
        'car_color',
        'car_register_card',
        'is_selected',
        'status',
    ];

      protected $casts = [
          'id' => 'integer',
          'company_id' => 'integer',
          'car_or_fleet_type_id' => 'integer',
          'car_or_fleet_make_id' => 'integer',
          'car_or_fleet_model_id' => 'integer',
      ];


    public function fleetType()
    {
        return $this->belongsTo(FleetType::class, 'car_type_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
