<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\DepartmentsResource;
use App\Departments;

class DepartmentsController extends Controller
{
    public function getAll(){
        return DepartmentsResource::collection(Departments::all());
    }
}
