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
        'velocity', 'river_id','coefficient','width'
    ];

    public function river()
    {
        return $this->belongsTo('App\River');
    }
}
