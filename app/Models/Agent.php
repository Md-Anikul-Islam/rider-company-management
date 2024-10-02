<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;use Laravel\Sanctum\HasApiTokens;

class Agent extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'profile',
        'status',
        'password',
    ];

    public function commissions()
    {
        return $this->hasOne(AgentCommission::class, 'agent_id');
    }

    public function trips()
    {
        return $this->hasMany(TripHistory::class, 'agent_id');
    }
}
