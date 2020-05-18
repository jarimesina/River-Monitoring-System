<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discharge extends Model
{
    protected $fillable = [
        'dischargeValue','river_id'
    ];

    public function river()
    {
        return $this->belongsTo('App\River');
    }
}
