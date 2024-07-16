<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;use Laravel\Sanctum\HasApiTokens;

class Passenger extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile',
        'password',
        'is_apple',
        'status'
    ];

      protected $casts = [
          'id' => 'integer',
          'is_apple' => 'string',
      ];
}
