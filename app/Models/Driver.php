<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'company_id',
        'car_id',
        'name',
        'email',
        'phone',
        'password',
        'gender',
        'dob',
        'address',
        'profile',
        'driving_licence_font_image',
        'driving_licence_back_image',
        'rta_card_font_image',
        'rta_card_back_image',
        'ratting',
        'status',
        'device_information',
    ];

      protected $casts = [
          'id' => 'integer',
          'company_id' => 'integer',
          'car_id' => 'integer',
      ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
    public function car()
    {
        return $this->belongsTo(CarOrFleet::class, 'car_id');
    }

}
