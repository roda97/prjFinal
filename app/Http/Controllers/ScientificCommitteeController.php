<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ScientificCommitteeResource;
use App\ScientificCommittee;

class ScientificCommitteeController extends Controller
{
    public function getAll(){
        return ScientificCommitteeResource::collection(ScientificCommittee::all());
    }

    public function deletereunion($id)
    {

        $scientificCommittee = ScientificCommittee::findOrFail($id);

        $scientificCommittee->delete();

        return new ScientificCommitteeResource($scientificCommittee);
    }

    public function createReunion(Request $request)
    {

        $request->validate([
            'room' => 'required',
            'description' => 'required',
            'datereunion' => 'required'
        ]);

        $scientificCommittee = new ScientificCommittee;
        
        $scientificCommittee->room = $request->room;
        $scientificCommittee->description = $request->description;
        $scientificCommittee->datereunion = $request->datereunion;
        
        if ($request->file('ata')){
            $name = "ata"."_".$scientificCommittee->id.'.'.$request->ata->getClientOriginalExtension();
            Storage::putFileAs('Atas', $request->ata, $name);
            Storage::disk("local")->putFileAs("Atas", $request->file('ata'),$name);
        }
      
        $scientificCommittee->save();

        return new ScientificCommitteeResource($scientificCommittee);
    }

    public function editReunion(Request $request, $id)
    {

        $scientificCommittee = ScientificCommittee::findOrFail($id);

        $request->validate([
            'room' => 'required',
            'description' => 'required',
            'datereunion' => 'required',
            
        ]);

        $scientificCommittee->update($request->all());
    }

}
