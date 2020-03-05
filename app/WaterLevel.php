<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterLevel extends Model
{
    protected $guarded = [];

    public function river()
    {
        return $this->belongsTo('App\River');
    }
}
