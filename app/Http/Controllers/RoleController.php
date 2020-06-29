<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RoleResource;
use App\Role;

class RoleController extends Controller
{
    public function getAll(){
        return RoleResource::collection(Role::all())->unique('name');
    }

    public function getRoles(){

        $roles= Role::join(
        'user_roles',
        'roles.id', 
        '=', 
        'user_roles.role_id')
        ->join(
        'users', 
        'user_roles.user_id',
        '=',
        'users.id')
        ->select(
        'user_roles.id AS row_id',
        'user_roles.user_id',
        'roles.name AS name',
        'roles.function AS function',
        'users.name AS user_name',
        'users.email AS user_email',
        'users.photo AS user_photo',
        'users.career AS user_career',
        'user_roles.role_id')
        ->orderBy('user_roles.user_id')
        ->get();

        return RoleResource::collection($roles);
    }

    public function getRolesFront(){

        $roles= Role::join(
        'user_roles',
        'roles.id', 
        '=', 
        'user_roles.role_id')
        ->join(
        'users', 
        'user_roles.user_id',
        '=',
        'users.id')
        ->leftJoin(
            'members_scientific_committees', 
            'user_roles.user_id',
            '=',
            'members_scientific_committees.user_id')
        ->select(
        'user_roles.id AS row_id',
        'user_roles.user_id',
        'users.career AS user_career',
        'roles.name AS name',
        'roles.function AS function',
        'users.name AS user_name',
        'users.academic_degree AS degree',
        'user_roles.role_id',
        'members_scientific_committees.scientific_committees_id')
        ->orderBy('user_roles.user_id')
        ->get();


        $roles = collect($roles)->sortBy('user_name')->keyBy('user_name', 'scientific_committees_id')->values();

        

      //  return RoleResource::collection($collection);
       return view('users_view', compact('roles'));
    }


    public function name(String $name){

    	return RoleResource::collection(Role::where('name', '=', $name)->get());
    }

}
