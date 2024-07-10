<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_id',
        'commission_percentage',
    ];

    protected $casts = [
        'id' => 'integer',
        'agent_id' => 'integer',
    ];
}
