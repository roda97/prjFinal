<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CountriesResource;
use App\Countries;

class CountriesController extends Controller
{
    public function getAll(){
        return CountriesResource::collection(Countries::all());
    }
}
