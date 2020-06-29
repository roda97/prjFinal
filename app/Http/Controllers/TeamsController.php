<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TeamsResource;
use App\Teams;
use Carbon\Carbon;

class TeamsController extends Controller
{
    public function getAll(){
        return TeamsResource::collection(Teams::all());
    }

    public function getTeamsFront(){

      $teams = TeamsResource::collection(Teams::all());
    
      return view('teams_view', compact('teams'));
    }

    public function createTeam(Request $request){
        
        $request->validate([
            'title' => 'required|string|unique:teams', 
            'keywords' => 'required',
            'scientific_domains' => 'required',
            'application_domains' => 'required',
        ]);

        $team = new Teams(); 

        $team->title = $request->title;
        $team->keywords = $request->keywords;
        $team->scientific_domains = $request->scientific_domains;
        $team->application_domains = $request->application_domains;
        $team->created_at = Carbon::now();
        $team->updated_at = Carbon::now();
        $team->isActive = 1;

        $team->save();

        return new TeamsResource($team); 
    }

    public function editTeam(Request $request, $id) {

        $team = Teams::findOrFail($id);

        $request->validate([
            'title' => 'required|string|unique:teams,title,'.$team->id,
            'keywords' => 'required',
            'scientific_domains' => 'required',
            'application_domains' => 'required'
        ]);

        $team->update($request->all());
    }

    public function deleteTeam($id){

    	$team = Teams::findOrFail($id);
 
        $team->delete();
    
        return new TeamsResource($team);
    }

    public function search(){
        if($search = \Request::get('q')){
            $teams = Teams::where(function($query)use($search){
                $query->orWhere('title', 'LIKE', "%$search%")
                      ->orWhere('keywords', 'LIKE', "%$search%")
                      ->orWhere('scientific_domains', 'LIKE', "%$search%")
                      ->orWhere('application_domains', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $teams = Teams::all();    
        }

        return $teams;
    }

    public function alterToActive($id)
    {
        $team = Teams::findOrFail($id);
        $team->isActive = !$team->isActive;
        $team->save();
        return new TeamsResource($team);
    }
}
