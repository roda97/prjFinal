<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PartnersResource;
use App\Patent;
use Carbon\Carbon;

class PatentsController extends Controller
{
    public function getAll(){
        return PartnersResource::collection(Patent::all());
    }
}
