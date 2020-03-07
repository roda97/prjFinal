<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_PrivilegesResource;
use App\CienciaVitaeClasses\CV_Privileges;

class CV_PrivilegesController extends Controller
{
    public function getAll()
    {
        return CV_PrivilegesResource::collection(CV_Privileges::all());
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $privilege = CV_Privileges::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'api_user_name' => $request->api_user_name,
                'api_user_privacy_level_code' => $request->api_user_privacy_level_code,
                'api_user_privacy_level_value' => $request->api_user_privacy_level_value,
                'api_user_role_code' => $request->api_user_role_code,
                'api_user_role_value' => $request->api_user_role_value,             
                'api_user_url' => $request->api_user_url,
                'privilege_ciencia_id' => $request->privilege_ciencia_id,
                'privilege_effective_privacy_level_code' => $request->privilege_effective_privacy_level_code,
                'privilege_effective_privacy_level_value' => $request->privilege_effective_privacy_level_value,
                'privilege_effective_role_code' => $request->privilege_effective_role_code,
                'privilege_effective_role_value' => $request->privilege_effective_role_value,
            ]
        );

        return new CV_PrivilegesResource($privilege);
    }
}
