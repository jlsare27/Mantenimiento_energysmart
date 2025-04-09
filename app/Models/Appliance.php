<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appliance extends Model
{
    protected $fillable = [
        'home_id',
        'name',
        'brand',
        'model',
        'category',
        'nominal_power',
        'daily_usage_hours',
        'energy_efficiency_label',
        'acquisition_year',
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class);
    }
}
