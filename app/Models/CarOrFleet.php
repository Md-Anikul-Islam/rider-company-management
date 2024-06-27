<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOrFleet extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
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
        'is_selected',
        'status',
    ];

      protected $casts = [
          'id' => 'integer',
          'company_id' => 'integer',
          'car_type_id' => 'integer',
      ];


    public function fleetType()
    {
        return $this->belongsTo(FleetType::class, 'car_type_id');
    }
}
