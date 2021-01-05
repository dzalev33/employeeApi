<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $casts = [
        'id' => 'string',
    ];
}
