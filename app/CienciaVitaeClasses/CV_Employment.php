<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Employment extends Model 
{
    public $table = "cv_employments";
    protected $fillable = [
        'user_science_id',

        'employment_category_value',
        'employment_category_other_value',
        'employment_category_code',
        'institution_institution_name',
        'institution_institution_address_city',
        'institution_institution_address_region',
        'institution_institution_address_country_code',
        'institution_institution_address_country_value',
        'institution_institution_sector_code',
        'institution_institution_sector_value',
        'institution_institution_identifier_type',
        'institution_institution_identifier_identifier',
        'other_identifiers_institution_identifier_type_0',
        'other_identifiers_institution_identifier_type_1',
        'position_type_value',
        'position_type_other_value',
        'position_type_code',
        'position_title_code',
        'position_title_value',
        'position_title_group_code',
        'position_title_group_value',
        'start_date_year',
        'end_date_year',
        'id_row_entry',
        'privacy_level',
        'source_name',
        'last_modified_date'

    ];

}