<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCommission extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'commission_amount',
    ];

      protected $casts = [
          'id' => 'integer',
          'company_id' => 'integer',
      ];
}
