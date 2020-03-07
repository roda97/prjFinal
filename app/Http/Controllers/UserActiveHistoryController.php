<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserActiveHistoryResource;
use App\UserActiveHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserActiveHistoryController extends Controller
{
    public function insertRecord(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'name'  => 'required',
            'changed_to' => 'required',
        ]);

        $userActiveHistory = new UserActiveHistory();

        $userActiveHistory->user_id = $request->user_id;
        $userActiveHistory->name = $request->name;
        $userActiveHistory->changed_to = $request->changed_to;
        $userActiveHistory->created_at = Carbon::now();
        $userActiveHistory->updated_at = Carbon::now();

        $userActiveHistory->save();

        return new UserActiveHistoryResource($userActiveHistory);
    }

}