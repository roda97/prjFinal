<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_EmploymentResource;
use App\CienciaVitaeClasses\CV_Employment;

class CV_EmploymentController extends Controller
{
    public function getAll()
    {
        return CV_EmploymentResource::collection(CV_Employment::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $employment = CV_Employment::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'employment_category_value' => $request->employment_category_value,
                'employment_category_other_value' => $request->employment_category_other_value,
                'employment_category_code' => $request->employment_category_code,
                'institution_institution_name' => $request->institution_institution_name,
                'institution_institution_address_city' => $request->institution_institution_address_city,
                'institution_institution_address_region' => $request->institution_institution_address_region,
                'institution_institution_address_country_code' => $request->institution_institution_address_country_code,
                'institution_institution_address_country_value' => $request->institution_institution_address_country_value,
                'institution_institution_sector_code' => $request->institution_institution_sector_code,
                
                'institution_institution_sector_value' => $request->institution_institution_sector_value,
                'institution_institution_identifier_type' => $request->institution_institution_identifier_type,
                'institution_institution_identifier_identifier' => $request->institution_institution_identifier_identifier,
                'other_identifiers_institution_identifier_type_0' => $request->other_identifiers_institution_identifier_type_0,
                'other_identifiers_institution_identifier_type_1' => $request->other_identifiers_institution_identifier_type_1,
                'position_type_value' => $request->position_type_value,
                'position_type_other_value' => $request->position_type_other_value,
                'position_type_code' => $request->position_type_code,
                'position_title_code' => $request->position_title_code,
                
                'position_title_value' => $request->position_title_value,
                'position_title_group_code' => $request->position_title_group_code,
                'position_title_group_value' => $request->position_title_group_value,
                'start_date_year' => $request->start_date_year,
                'end_date_year' => $request->end_date_year,
                'id_row_entry' => $request->id_row_entry,
                'privacy_level' => $request->privacy_level,
                'source_name' => $request->source_name,
                'last_modified_date' => $request->last_modified_date,
            ]
        );

        return new CV_EmploymentResource($employment);
    }
}
