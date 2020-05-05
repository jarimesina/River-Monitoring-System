<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'river_id','coefficient','width','shape','vertical_distance','triangleHeight'
    ];

    public function river()
    {
        return $this->belongsTo('App\River');
    }
}
