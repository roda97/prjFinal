<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_WebResource;
use App\CienciaVitaeClasses\CV_Web;

class CV_WebController extends Controller
{
    public function getAll()
    {
        return CV_WebResource::collection(CV_Web::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $web = CV_Web::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'site_type_code' => $request->site_type_code,
                'site_type_value' => $request->site_type_value,
                'url' => $request->url,
                'id_row_entry' => $request->id_row_entry,
                'last_modified_date' => $request->last_modified_date,
            ]
        );

        return new CV_WebResource($web);
    }
}
