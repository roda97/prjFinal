<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Web extends Model
{
    public $table = "cv_webs";
    protected $fillable = [
        'user_science_id',

        'site_type_code',
        'site_type_value',
        'url',
        'id_row_entry',
        'last_modified_date',
    ];

}
