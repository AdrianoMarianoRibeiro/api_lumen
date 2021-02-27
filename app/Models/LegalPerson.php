<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LegalPerson
 * @property string person_id
 * @property string company_name
 * @package App\Models
 */
class LegalPerson extends Model
{
    protected $table = "v1.legal_persons";

    protected $primaryKey = 'person_id';

    protected $fillable = [
        'person_id', 'company_name',
    ];

     public $timestamps = true;
}
