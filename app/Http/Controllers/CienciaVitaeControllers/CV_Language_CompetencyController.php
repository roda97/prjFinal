<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CienciaVitaeResources\CV_Language_CompetencyResource;
use App\CienciaVitaeClasses\CV_Language_Competency;

class CV_Language_CompetencyController extends Controller
{
    public function getAll()
    {
        return CV_Language_CompetencyResource::collection(CV_Language_Competency::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $language = CV_Language_Competency::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'language_code' => $request->language_code,
                'language_value' => $request->language_value,
                'mother_tongue' => $request->mother_tongue,
                'read_value' => $request->read_value,
                'read_code' => $request->read_code,
                'write_value' => $request->write_value,
                'write_code' => $request->write_code,
                'speak_value' => $request->speak_value,
                'speak_code' => $request->speak_code,
                'understand_spoken_value' => $request->understand_spoken_value,
                'understand_spoken_code' => $request->understand_spoken_code,
                'privacy_level' => $request->privacy_level,
                'peer_review' => $request->peer_review,
            ]
        );

        return new CV_Language_CompetencyResource($language);
    }
}
