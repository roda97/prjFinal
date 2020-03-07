<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Author extends Model 
{
    public $table = "cv_authors";
    protected $fillable = [
        'user_science_id',

        'identifier_type_code',
        'identifier_type_value',
        'identifier',
        'id_row_entry',
        'privacy_level',
        'source_name',
        'last_modified_date',
    ];

}