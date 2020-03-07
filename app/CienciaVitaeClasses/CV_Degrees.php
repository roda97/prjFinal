<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Degrees extends Model 
{
    public $table = "cv_degrees";
    protected $fillable = [
        'user_science_id',

        'degree_id',
        'degree_type_value',
        'degree_type_code',
        'degree_code_value',
        'degree_code_speciality_code',
        'degree_name',

        'institution_name',
        'institution_city',
        'institution_country',
        'degree_major',
        'degree_status_value',
        'degree_status_code',
        'description',
       
        'degree_end_date',
        'privacy_level',
        'research_classifications',
        'source_name',
        'start_date',
        'thesis',
        'last_modified_date',
    ];

}