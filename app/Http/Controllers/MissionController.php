<?php

namespace App\Http\Controllers;

use App\Http\Resources\MissionResource;
use App\Mission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MissionController extends Controller
{

    public function getMission($id)
    {
        return Mission::find($id);
    }

    public function editMission(Request $request, $id)
    {

        $mission = Mission::findOrFail($id);

        $request->validate([
            'text' => 'required',
        ]);

        $mission->update($request->only(['text']));
        
    }
}
