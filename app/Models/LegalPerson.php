<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalPerson extends Model
{
    protected $table = "v1.legal_persons";

    protected $fillable = [
        'person_id', 'company_name',
    ];

    // public $timestamps = false;
}
