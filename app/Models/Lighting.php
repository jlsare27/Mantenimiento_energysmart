<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lighting extends Model
{
    protected $fillable = [
        'home_id',
        'bulb_type',
        'power',
        'quantity',
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class);
    }
}
