<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\MemberScientificCommitteeResource;
use App\MembersScientificCommittee;
use App\User;
use Carbon\Carbon;

class MembersScientificCommitteeController extends Controller
{
    public function createMember(Request $request){
        
        /*
        $request->validate([
            'userSelected' => 'required', 
            'committeeSelected' => 'required',     
        ]);

        //$user = User::findOrFail($request["userSelected"]);

        $member = new MembersScientificCommittee(); 

        $member->user_id = $request->userSelected;
        $member->scientific_committees_id = $request->committeeSelected;
        $member->created_at = Carbon::now();
        $member->updated_at = Carbon::now();

        $member->save();

        return new MemberScientificCommitteeResource($member);
        */
        
        $request->validate([
            'userSelected' => 'required',
        ]);

        $member = MembersScientificCommittee::updateOrCreate(
            ['user_id' => $request->userSelected, 'scientific_committees_id' => '1'],
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        );

        return new MemberScientificCommitteeResource($member);

    }

    public function deleteMember($id){

    	$member = MembersScientificCommittee::findOrFail($id);
 
        $member->delete();
    
        return new MemberScientificCommitteeResource($member);
    }

    public function search(){
        if($search = \Request::get('q')){
            $members = MembersScientificCommittee::where(function($query)use($search){
                $query ->join('users', 'members_scientific_committees.user_id', '=','users.id')
                      ->where('user_id', 'LIKE', "%$search%")
                      ->orWhere('name', 'LIKE', "%$search%")
                      ->orWhere('start_date', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $members = MembersScientificCommittee::all();    
        }

        return $members;
    }
}
