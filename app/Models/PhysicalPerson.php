<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhysicalPerson
 * @property string person_id
 * @property mixed birth_date
 * @package App\Models
 */
class PhysicalPerson extends Model
{
    protected $table = "v1.physical_people";

    protected $primaryKey = 'person_id';

    protected $fillable = [
        'person_id', 'birth_date',
    ];

     public $timestamps = true;
}
