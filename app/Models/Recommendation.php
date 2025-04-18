<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = [
        'type', 'description', 'priority', 'implemented', 'potential_savings'
    ];
    
    public function home()
    {
        return $this->belongsTo(Home::class);
    }
}