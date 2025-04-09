<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Home extends Model
{
    protected $fillable = [
        'user_id',
        'location',
        'general_characteristics',
        'connection_type',
        'tariff_id',
    ];

    // Relación con el usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación con electrodomésticos
    public function appliances(): HasMany
    {
        return $this->hasMany(Appliance::class);
    }

    // Relación con iluminación
    public function lightings(): HasMany
    {
        return $this->hasMany(Lighting::class);
    }
    
    // Relación con el historial de consumo
    public function consumptionHistories(): HasMany
    {
        return $this->hasMany(ConsumptionHistory::class);
    }

    // Relación con recomendaciones
    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }

    // Relación con tarifa (si se asigna manualmente)
    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }
}
