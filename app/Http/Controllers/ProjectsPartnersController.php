<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectsPartnersResource;
use App\Project;
use App\PartnersProjects;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectsPartnersController extends Controller
{
    public function add(Request $request)
    {

        $request->validate([
            'partnerSelected' => 'required',
            'projectSelected' => 'required',
        ]);

        $partnerToProject = PartnersProjects::updateOrCreate(
            ['partner_id' => $request->partnerSelected, 'project_id' => $request->projectSelected],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        );

        return new ProjectsPartnersResource($partnerToProject);

    }

    public function getPartnersPerProject()
    {

        $partners =
        Project::join('partners_projects',
            'projects.id', '=', 'partners_projects.project_id')
            ->join('partners',
             'partners_projects.partner_id', '=', 'partners.id')
            ->select('partners_projects.id AS partners_projects_id', 
            'partners.id AS partner_id', 
            'partners.name', 
            'partners_projects.project_id', 
            'projects.title')
            ->get();

        return ProjectsPartnersResource::collection($partners);
    }

    public function deletePartnerFromProject($id)
    {

        $partner = PartnersProjects::findOrFail($id);

        $partner->delete();

        return new ProjectsPartnersResource($partner);
    }

    public function getPartnerInProjects($id)
    {
        return new ProjectsPartnersResource(PartnersProjects::find($id));
    }

    public function checkPartnerInProjects($id)
    {
        /*
        $partner = PartnersProjects::find($id);
        if($partner === null){
            return FALSE;
        }
        else{
            return TRUE;
        }
        */
        return new ProjectsPartnersResource(PartnersProjects::find($id));
        
    }

    public function findRowPartnerInProject($id)
    {

    }

    /*public function search(){
        if($search = \Request::get('q')){
            $partnersProjects = PartnersProjects::where(function($query)use($search){
                $query->where('partner_id', 'LIKE', "%$search%")
                      ->orWhere('name', 'LIKE', "%$search%")
                      ->orWhere('project_id', 'LIKE', "%$search%")
                      ->orWhere('title', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $partnersProjects = PartnersProjects::all();    
        }

        return $partnersProjects;
    }*/

}
