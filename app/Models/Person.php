<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @package App\Models
 */
class Person extends Model
{
    protected $table = "v1.people";

    protected $fillable = ['name'];

    // public $timestamps = false;
}
