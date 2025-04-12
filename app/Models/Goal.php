<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'name', 'target_consumption', 'target_date',
        'current_consumption', 'status', 'notes'
    ];
    
    protected $dates = ['target_date'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function home()
    {
        return $this->belongsTo(Home::class);
    }
}