<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ProjectsResource;
use App\Project;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:api');
    }*/

    public function getAll(){
        return ProjectsResource::collection(Project::all());
    }

    public function createProject(Request $request){
        
        $request->validate([
            'title' => 'required|unique:projects',
            'abstract' => 'required',         
        ]);

        $project = new Project(); 

        $project->title = $request->title;
        $project->abstract = $request->abstract;
        $project->total_budget = $request->total_budget;
        $project->ciic_budget = $request->ciic_budget;
        $project->consortium = $request->consortium;
        $project->funding = $request->funding;
        $project->proponent = $request->proponent;
        $project->created_at = Carbon::now();
        $project->updated_at = Carbon::now();

        $project->save();

        return new ProjectsResource($project); 
    }

    public function deleteProject($id){

    	$project = Project::findOrFail($id);
 
        $project->delete();
    
        return new ProjectsResource($project);
    }

    public function editProject(Request $request, $id) {

        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:projects,title,'.$project->id,
            'abstract' => 'required', 
        ]);

        $project->update($request->all());
    }

    public function getProject($id)
    {
        return new ProjectsResource(Project::find($id));
    }

    public function search(){
        if($search = \Request::get('q')){
            $projects = Project::where(function($query)use($search){
                $query->where('title', 'LIKE', "%$search%")
                      ->orWhere('abstract', 'LIKE', "%$search%")
                      ->orWhere('consortium', 'LIKE', "%$search%")
                      ->orWhere('funding', 'LIKE', "%$search%")
                      ->orWhere('proponent', 'LIKE', "%$search%")
                      ->orWhere('total_budget', 'LIKE', "%$search%")
                      ->orWhere('ciic_budget', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $projects = Project::all();    
        }

        return $projects;
    }
}