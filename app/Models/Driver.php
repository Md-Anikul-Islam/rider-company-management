<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
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
    ];

}
