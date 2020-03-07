<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PartnersResource;
use App\Partners;
use Carbon\Carbon;

class PartnersController extends Controller
{
    public function getAll(){
        return PartnersResource::collection(Partners::all());
    }

    public function createPartner(Request $request){
        
        $request->validate([
            'name' => 'required|string|unique:partners', 
        ]);

        $partner = new Partners(); 

        $partner->name = $request->name;
        $partner->created_at = Carbon::now();
        $partner->updated_at = Carbon::now();

        $partner->save();

        return new PartnersResource($partner); 
    }

    public function editPartner(Request $request, $id) {

        $partner = Partners::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:partners,name,'.$partner->id,
        ]);

        $partner->update($request->all());
    }

    public function deletePartner($id){

    	$partner = Partners::findOrFail($id);
 
        $partner->delete();
    
        return new PartnersResource($partner);
    }

    public function search(){
        if($search = \Request::get('q')){
            $partners = Partners::where(function($query)use($search){
                $query->where('name', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $partners = Partners::all();    
        }

        return $partners;
    }
}