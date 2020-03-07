<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Person_Info extends Model
{
    public $table = "cv_person_infos";
    protected $fillable = [
        'user_science_id',

        'full_name',
        'names',
        'surnames',
        'presented_name',
        'date_of_birth_year',
        'date_of_birth_month',
        'date_of_birth_day',
        'gender_value',
    ];

}
