<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\AddressResource;
use App\Address;

class AddressController extends Controller
{
    public function getAll(){
        return AddressResource::collection(Address::all());
    }
}
