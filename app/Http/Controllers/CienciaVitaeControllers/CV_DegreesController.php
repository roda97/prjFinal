<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use App\CienciaVitaeClasses\CV_Degrees;
use App\Http\Controllers\Controller;
use App\Http\Resources\CienciaVitaeResources\CV_DegreesResource;
use Illuminate\Http\Request;

class CV_DegreesController extends Controller
{
    public function getAll()
    {
        return CV_DegreesResource::collection(CV_Degrees::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {
        $degree = CV_Degrees::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'degree_id' => $request->degree_id,             
                'degree_type_value' => $request->degree_type_value,
                'degree_type_code' => $request->degree_type_code,
                'degree_code_value' => $request->degree_code_value,
                'degree_code_speciality_code' => $request->degree_code_speciality_code,
                'degree_name' => $request->degree_name,

                'institution_name' => $request->institution_name,
                'institution_city' => $request->institution_city,
                'institution_country' => $request->institution_country,
                'degree_major' => $request->degree_major,
                'degree_status_value' => $request->degree_status_value,
                'degree_status_code' => $request->degree_status_code,
                'description' => $request->description,

                'degree_end_date' => $request->degree_end_date,           
                'privacy_level' => $request->privacy_level,
                'research_classifications' => $request->research_classifications,
                'source_name' => $request->source_name,
                'start_date' => $request->start_date,
                'thesis' => $request->thesis,
                'last_modified_date' => $request->last_modified_date,
            ]
        );

        return new CV_DegreesResource($degree);
    }

}
