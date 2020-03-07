<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_CitationResource;
use App\CienciaVitaeClasses\CV_Citation;

class CV_CitationController extends Controller
{
    public function getAll()
    {
        return CV_CitationResource::collection(CV_Citation::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $citation = CV_Citation::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,

                'value' => $request->value,
                'id_row_entry' => $request->id_row_entry,
                'privacy_level' => $request->privacy_level,
                'source_name' => $request->source_name,
                'last_modified_date' => $request->last_modified_date,
                'preferred_citation_name' => $request->preferred_citation_name

            ]
        );

        return new CV_CitationResource($citation);
    }
}
