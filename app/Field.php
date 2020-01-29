<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'field1',
        'field2',
        'field3',
        'field4',
        'created_at',
        'updated_at',
    ];
}
