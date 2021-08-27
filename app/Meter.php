<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    protected $appends = [
        'power'
    ];
    public function user() {
        return $this->belongsTo('App\User', 'meter_number', 'meter_number');
    }

    public function powerConsumed() {
        return $this->hasMany("App\PowerConsumed");
    }

    public function getPowerAttribute() {
        return $this->powerConsumed()->get()->last();
    }
}
