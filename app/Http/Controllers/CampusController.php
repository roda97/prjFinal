<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CampusResource;
use App\Campus;

class CampusController extends Controller
{
    public function getAll(){
        return CampusResource::collection(Campus::all());
    }
}
