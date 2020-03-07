<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use App\CienciaVitaeClasses\CV_Author;
use App\Http\Controllers\Controller;
use App\Http\Resources\CienciaVitaeResources\CV_AuthorResource;
use Illuminate\Http\Request;


class CV_AuthorController extends Controller
{
    public function getAll()
    {
        return CV_AuthorResource::collection(CV_Author::all());
    }
    
    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $author = CV_Author::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,

                'identifier_type_code' => $request->identifier_type_code,
                'identifier_type_value' => $request->identifier_type_value,
                'identifier' => $request->identifier,
                'id_row_entry' => $request->id_row_entry,
                'privacy_level' => $request->privacy_level,
                'source_name' => $request->source_name,
                'last_modified_date' => $request->last_modified_date

            ]
        );

        return new CV_AuthorResource($author);
    }
}
