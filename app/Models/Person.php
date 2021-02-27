<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @property string person_id
 * @property string name
 * @package App\Models
 */
class Person extends Model
{
    protected $table = "v1.people";

    protected $primaryKey = 'person_id';

    public $incrementing = false;

    protected $fillable = ['person_id', 'name'];

     public $timestamps = true;
}
