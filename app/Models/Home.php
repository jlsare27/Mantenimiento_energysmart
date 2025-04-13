<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'state', 'zip_code',
        'connection_type', 'occupants', 'area', 'energy_tariff'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function appliances()
    {
        return $this->hasMany(Appliance::class);
    }
    
    public function lightings()
    {
        return $this->hasMany(Lighting::class);
    }
    
    public function energyConsumptions()
    {
        return $this->hasMany(EnergyConsumption::class);
    }
    
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
    
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}