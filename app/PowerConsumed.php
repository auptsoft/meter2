<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerConsumed extends Model
{
    
    public function meter() {
        return $this->belongsTo("App\Meter");
    }
}
