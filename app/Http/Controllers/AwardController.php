<?php

namespace App\Http\Controllers;

use App\Award;
use Illuminate\Http\Request;
use App\Http\Resources\AwardResource;
use Carbon\Carbon;

class AwardController extends Controller
{

    public function getAll(){
        return AwardResource::collection(Award::all());
    }

    public function createAward(Request $request){
        
        $request->validate([
            'title' => 'required|unique:awards', 
            'description' => 'required|min:10',
        ]);

        $award = new Award(); 

        $award->user_id = auth('api')->user()->id;
        $award->title = $request->title;
        $award->description = $request->description;
        $award->created_at = Carbon::now();
        $award->updated_at = Carbon::now();

        $award->save();

        return new AwardResource($award); 
    }

    public function editAward(Request $request, $id) {

        $award = Award::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:awards,title,'.$award->id,
            'description' => 'required|min:10',
        ]);

        $award->update($request->all());
    }

    public function deleteAward($id){

    	$award = Award::findOrFail($id);
 
        $award->delete();
    
        return new AwardResource($award);
    }
    
    public function search(){
        if($search = \Request::get('q')){
            $awards = Award::where(function($query)use($search){
                $query->where('title', 'LIKE', "%$search%")
                      ->orWhere('description', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $awards = Award::all();    
        }

        return $awards;
    }
}
