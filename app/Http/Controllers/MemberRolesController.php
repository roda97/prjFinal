<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\MemberRolesResource;
use App\MemberRoles;
use App\User;
use Carbon\Carbon;

class MemberRolesController extends Controller
{
    public function createMemberRole(Request $request){
        
    
        $request->validate([
            'userSelected' => 'required', 
            'roleSelected' => 'required',
            'functionSelected' => 'required',      
        ]);

        $memberRole = new MemberRoles(); 

        $memberRole->user_id = $request->userSelected;
        $memberRole->role_id = $request->functionSelected;
        $memberRole->created_at = Carbon::now();
        $memberRole->updated_at = Carbon::now();

        $memberRole->save();

        return new MemberRolesResource($memberRole);

    }

    public function deleteMemberRole($id){

    	$memberRole = MemberRoles::findOrFail($id);
 
        $memberRole->delete();
    
        return new MemberRolesResource($memberRole);
    }
}
