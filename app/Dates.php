<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
    protected $fillable = [
        'start', 'end'
    ];
}
