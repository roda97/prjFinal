<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_Person_InfoResource;
use App\CienciaVitaeClasses\CV_Person_Info;

class CV_Person_InfoController extends Controller
{
    public function getAll()
    {
        return CV_Person_InfoResource::collection(CV_Person_Info::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $person = CV_Person_Info::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'full_name' => $request->full_name,
                'names' => $request->names,
                'surnames' => $request->surnames,
                'presented_name' => $request->presented_name,
                'date_of_birth_year' => $request->date_of_birth_year,
                'date_of_birth_month' => $request->date_of_birth_month,
                'date_of_birth_day' => $request->date_of_birth_day,
                'gender_value' => $request->gender_value,
            ]
        );

        return new CV_Person_InfoResource($person);
    }
}
