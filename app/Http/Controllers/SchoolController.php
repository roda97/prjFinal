<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\SchoolResource;
use App\School;

class SchoolController extends Controller
{
    public function getAll(){
        return SchoolResource::collection(School::all());
    }
}
