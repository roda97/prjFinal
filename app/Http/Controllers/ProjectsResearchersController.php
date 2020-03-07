<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectsResearchersResource;
use App\Project;
use App\ProjectResearchers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectsResearchersController extends Controller
{
    public function add(Request $request)
    {

        $request->validate([
            'userSelected' => 'required',
            'projectSelected' => 'required',
        ]);

        $researcherToProject = ProjectResearchers::updateOrCreate(
            ['user_id' => $request->userSelected, 'project_id' => $request->projectSelected],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        );

        return new ProjectsResearchersResource($researcherToProject);

    }

    public function getResearchersPerProject()
    {

        $researchers =

        Project::join('project_researchers',
            'projects.id', '=', 'project_researchers.project_id')
            ->join('users', 'project_researchers.user_id', '=', 'users.id')
            ->select(
            'project_researchers.id AS project_researchers_id',
            'users.id AS user_id', 
            'users.name AS user_name', 
            'project_researchers.project_id', 
            'projects.title AS project_title')
            ->get();

        return ProjectsResearchersResource::collection($researchers);
    }

    public function deleteResearcherFromProject($id)
    {

        $researcher = ProjectResearchers::findOrFail($id);

        $researcher->delete();

        return new ProjectsResearchersResource($researcher);
    }

}
