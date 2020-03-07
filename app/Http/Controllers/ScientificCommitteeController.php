<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ScientificCommitteeResource;
use App\ScientificCommittee;

class ScientificCommitteeController extends Controller
{
    public function getMembers(){

        $members= ScientificCommittee::join(
        'members_scientific_committees',
        'scientific_committees.id', 
        '=', 
        'members_scientific_committees.scientific_committees_id')
        ->join(
        'users', 
        'members_scientific_committees.user_id',
        '=',
        'users.id')
        ->select(
        'members_scientific_committees.id AS row_id',
        'members_scientific_committees.user_id',
        'scientific_committees.start_date',
        'users.name AS user_name',
        'members_scientific_committees.scientific_committees_id')
        ->get();

        return ScientificCommitteeResource::collection($members);
    }

    public function getMembersFront(){

        $members= ScientificCommittee::join(
        'members_scientific_committees',
        'scientific_committees.id', 
        '=', 
        'members_scientific_committees.scientific_committees_id')
        ->leftJoin(
        'users', 
        'members_scientific_committees.user_id',
        '=',
        'users.id')
        ->select(
        'members_scientific_committees.id AS row_id',
        'members_scientific_committees.user_id',
        'scientific_committees.start_date',
        'users.name AS user_name',
        'users.academic_degree AS degree',
        'members_scientific_committees.scientific_committees_id AS science_id')
        ->get();

        return ScientificCommitteeResource::collection($members);
     //   return view('users_view', compact('members'));

    }

    public function getAll(){
        return ScientificCommitteeResource::collection(ScientificCommittee::all());
    }
}
