<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recommendation extends Model
{
    protected $fillable = [
        'home_id',
        'title',
        'description',
    ];

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class);
    }
}
