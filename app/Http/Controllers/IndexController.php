<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class IndexController extends Controller
{
    public function index(){
        $projects = Project::inRandomOrder()->take(6)->get();
        
        return view('index', compact('projects'));
    }
}
