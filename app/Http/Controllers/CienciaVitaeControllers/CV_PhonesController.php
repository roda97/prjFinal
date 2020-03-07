<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_PhonesResource;
use App\CienciaVitaeClasses\CV_Phones;

class CV_PhonesController extends Controller
{
    public function getAll()
    {
        return CV_PhonesResource::collection(CV_Phones::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $phone = CV_Phones::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'usage_type_code' => $request->usage_type_code,
                'usage_type_value' => $request->usage_type_value,
                'phone_type_code' => $request->phone_type_code,
                'phone_type_value' => $request->phone_type_value,
                'country_code' => $request->country_code,
                'local_number' => $request->local_number,
                'id_row_entry' => $request->id_row_entry,
                'preferred_phone_number' => $request->preferred_phone_number,
                'last_modified_date' => $request->last_modified_date,
            ]
        );

        return new CV_PhonesResource($phone);
    }
}
