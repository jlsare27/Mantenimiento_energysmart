<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnergyConsumption extends Model
{
    protected $fillable = [
        'period_date', 'total_consumption', 'estimated_cost', 'breakdown'
    ];
    
    protected $casts = [
        'breakdown' => 'array',
    ];
    
    public function home()
    {
        return $this->belongsTo(Home::class);
    }
}