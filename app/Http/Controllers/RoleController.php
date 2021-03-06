<?php

namespace App\Http\Controllers;

use App\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RoleResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleController extends Controller
{
    public function getAll(){
        return RoleResource::collection(Role::all())->unique('name');
    }

    public function getRolesFullMember(){

        $roles= DB::select('SELECT t1.* , t3.name AS user_name, t4.name AS name, t3.email AS user_email, t3.photo AS user_photo, t4.function AS function, t3.career AS user_career FROM user_roles t1, users t3, roles t4 WHERE t3.id = t1.user_id AND t4.id = t1.role_id AND t1.created_at = (SELECT MAX(t2.created_at) FROM user_roles t2 WHERE t2.user_id = t1.user_id) order by function DESC');
    
        $roles = collect($roles)->where('name','Full Member')->values();

        $roles = $this->paginate($roles,10);

        return $roles;
        //return collect($roles);
    }

    public function getRolesExternalMember(){

        $roles= DB::select('SELECT t1.* , t3.name AS user_name, t4.name AS name, t3.email AS user_email, t3.photo AS user_photo, t4.function AS function, t3.career AS user_career FROM user_roles t1, users t3, roles t4 WHERE t3.id = t1.user_id AND t4.id = t1.role_id AND t1.created_at = (SELECT MAX(t2.created_at) FROM user_roles t2 WHERE t2.user_id = t1.user_id) order by function DESC');
    
        $roles = collect($roles)->where('name','External Member')->values();

        $roles = $this->paginate($roles,10);

        return $roles;
        //return collect($roles);
    }

    public function getRolesCollaboratorMember(){

        $roles= DB::select('SELECT t1.* , t3.name AS user_name, t4.name AS name, t3.email AS user_email, t3.photo AS user_photo, t4.function AS function, t3.career AS user_career FROM user_roles t1, users t3, roles t4 WHERE t3.id = t1.user_id AND t4.id = t1.role_id AND t1.created_at = (SELECT MAX(t2.created_at) FROM user_roles t2 WHERE t2.user_id = t1.user_id) order by function DESC');
    
        $roles = collect($roles)->where('name','Collaborator Member')->values();

        $roles = $this->paginate($roles,10);

        return $roles;
        //return collect($roles);
    }

    public function paginate($items, $perPage, $page = null, $options = []) { 
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1); 
        $items = $items instanceof Collection ? $items : Collection::make($items); 
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options); 
    }

    public function getRolesFront(){

        $roles= DB::select('SELECT t1.* , t3.name AS user_name, t4.name AS name, t3.email AS user_email, t3.photo AS user_photo, t4.function AS function, t3.career AS user_career, t3.academic_degree AS degree FROM user_roles t1, users t3, roles t4 WHERE t3.id = t1.user_id AND t4.id = t1.role_id AND t1.created_at = (SELECT MAX(t2.created_at) FROM user_roles t2 WHERE t2.user_id = t1.user_id) order by function DESC');


        $roles = collect($roles);
        


      //  return RoleResource::collection($collection);
       return view('users_view', compact('roles'));
    }



    public function name(String $name){

    	return RoleResource::collection(Role::where('name', '=', $name)->get());
    }

}
