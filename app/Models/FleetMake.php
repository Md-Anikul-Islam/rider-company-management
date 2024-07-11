<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetMake extends Model
{
    use HasFactory;
    protected $fillable = [
        'fleet_type_id',
        'car_make_name',
        'status',
    ];
    protected $casts = [
        'id' => 'integer',
        'fleet_type_id' => 'integer',
    ];
    public function fleetType()
    {
        return $this->belongsTo(FleetType::class);
    }
}
