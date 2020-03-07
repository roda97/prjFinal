<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Citation extends Model 
{
    public $table = "cv_citations";
    protected $fillable = [
        'user_science_id',

        'value',
        'id_row_entry',
        'privacy_level',
        'source_name',
        'last_modified_date',
        'preferred_citation_name'
    ];

}