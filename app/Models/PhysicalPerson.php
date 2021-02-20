<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhysicalPerson
 * @package App\Models
 */
class PhysicalPerson extends Model
{
    protected $table = "v1.physical_people";

    protected $fillable = [
        'person_id', 'birth_date',
    ];

    // public $timestamps = false;
}
