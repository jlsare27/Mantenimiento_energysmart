<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'region',
        'price_per_kwh',
    ];

    // Si se requiere relacionar con hogares (una tarifa puede estar asignada a muchos hogares)
    public function homes()
    {
        return $this->hasMany(Home::class);
    }
}
