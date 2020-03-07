<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CienciaVitaeResources\CV_MailingAddressesResource;
use App\CienciaVitaeClasses\CV_MailingAddresses;


class CV_MailingAddressesController extends Controller
{
    public function getAll()
    {
        return CV_MailingAddressesResource::collection(CV_MailingAddresses::all());
    }
    
    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {

        $mailing = CV_MailingAddresses::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                'user_science_id' => null,
                
                'address_type_value' => $request->address_type_value,
                'address_type_code' => $request->address_type_code,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'province_state' => $request->province_state,
                'country_value' => $request->country_value,
                'preferred_mailing_address' => $request->preferred_mailing_address,
                'last_modified_date' => $request->last_modified_date,
                'privacy_level' => $request->privacy_level,
            ]
        );

        return new CV_MailingAddressesResource($mailing);
    }
}
