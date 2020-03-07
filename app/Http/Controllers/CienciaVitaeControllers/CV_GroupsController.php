<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_GroupsResource;
use App\CienciaVitaeClasses\CV_Groups;

class CV_GroupsController extends Controller
{
    public function getAll()
    {
        return CV_GroupsResource::collection(CV_Groups::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $group = CV_Groups::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'fundings_outputs' => $request->fundings_outputs,
                'employments_services' => $request->employments_services,
            ]
        );

        return new CV_GroupsResource($group);
    }
}
