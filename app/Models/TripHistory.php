<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'passenger_id',
        'driver_id',
        'origin_address',
        'destination_address',
        'change_destination_address',
        'pic_time',
        'drop_time',
        'passenger_name',  //use only manual trip request
        'passenger_phone', //use only manual trip request
        'estimated_fare',  //use only manual trip request
        'calculated_fare',
        'fare_received_status', //use only manual trip request and status should be 1 otherwise 0 always
        'trip_status',     //use trip start and trip end as like , 1=trip start, 2=trip end
        'trip_type',       //use trip type as like , 1=manual trip, 2=request trip
    ];

          protected $casts = [
              'id' => 'integer',
              'driver_id' => 'integer',
              'driver_id' => 'integer',
          ];
}
