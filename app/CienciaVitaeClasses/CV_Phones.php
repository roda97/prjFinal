<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Phones extends Model
{
    public $table = "cv_phones";
    protected $fillable = [
        'user_science_id',

        'usage_type_code',
        'usage_type_value',
        'phone_type_code',
        'phone_type_value',
        'country_code',
        'local_number',
        'id_row_entry',
        'preferred_phone_number',
        'last_modified_date',
    ];

}
