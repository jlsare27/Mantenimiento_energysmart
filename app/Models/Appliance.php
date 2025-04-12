<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    protected $fillable = [
        'name', 'brand', 'model', 'category', 'power',
        'hours_use', 'quantity', 'energy_efficiency',
        'year_acquired', 'notes'
    ];
    
    public function home()
    {
        return $this->belongsTo(Home::class);
    }
    
    // Calcula el consumo diario en kWh
    public function getDailyConsumptionAttribute()
    {
        return ($this->power * $this->hours_use * $this->quantity) / 1000;
    }
}