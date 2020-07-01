<?php

namespace App\Http\Controllers;

use App\ScientificCommittee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ScientificCommitteeResource;

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
            'datereunion' => 'required',
            
        ]);

        $scientificCommittee = new ScientificCommittee;
        
        $scientificCommittee->room = $request->room;
        $scientificCommittee->description = $request->description;
        $scientificCommittee->datereunion = $request->datereunion;

        if($request->atab64) {
            $base64_string = explode(',', $request->atab64);
            $imageBin = base64_decode($base64_string[1]);
            $nomefile = time() . '_' . $request->ata;
            if (!Storage::disk('public')->exists('Atas/' . $nomefile)) {
                Storage::disk('public')->put('Atas/' . $nomefile, $imageBin);
            }
        
        $scientificCommittee->ata = $nomefile;
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

        $scientificCommittee->room = $request->room;
        $scientificCommittee->description = $request->description;
        $scientificCommittee->datereunion = $request->datereunion;

        if($request->atab64) {
            $base64_string = explode(',', $request->atab64);
            $imageBin = base64_decode($base64_string[1]);
            $nomefile = time() . '_' . $request->ata;
            if (!Storage::disk('public')->exists('Atas/' . $nomefile)) {
                Storage::disk('public')->put('Atas/' . $nomefile, $imageBin);
            }
        
        $scientificCommittee->ata = $nomefile;
    }

        $scientificCommittee->update();
        
    }

}
