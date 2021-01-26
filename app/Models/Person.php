<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "v1.people";

    protected $fillable = [
        'name',
    ];

    // public $timestamps = false;
}
