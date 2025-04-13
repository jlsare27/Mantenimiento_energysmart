<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lighting extends Model
{
    protected $fillable = [
        'type', 'power', 'quantity', 'hours_use', 'location'
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