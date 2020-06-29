<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamActiveHistoryResource;
use App\TeamActiveHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeamActiveHistoryController extends Controller
{
    public function insertTeamRecord(Request $request)
    {

        $request->validate([
            'team_id' => 'required',
            'changed_to' => 'required',
        ]);

        $teamActiveHistory = new TeamActiveHistory();

        $teamActiveHistory->team_id = $request->team_id;
        $teamActiveHistory->changed_to = $request->changed_to;
        $teamActiveHistory->created_at = Carbon::now();
        $teamActiveHistory->updated_at = Carbon::now();

        $teamActiveHistory->save();

        return new TeamActiveHistoryResource($teamActiveHistory);
    }

}