<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\LaboratoriesResource;
use App\Laboratories;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class LaboratoriesController extends Controller
{
    public function getAll(){
        return LaboratoriesResource::collection(Laboratories::all());
    }

    public function createLab(Request $request){
        
        $request->validate([
            'laboratoy_real_id' => 'required|unique:laboratories', 
            'school_campus_name' => 'required|string',
            'name' => 'required|string',
            'number_work_posts' => 'required|integer',
            'area_m2' => 'required|numeric|between:0,999.99',
            'workgroup' => 'required',
            'lab_img_path' => 'nullable'          
        ]);

        $lab = new Laboratories(); 
        
        $exploded = explode(',', $request->lab_img_path);
        //return response()->json($exploded,402);
        if($exploded[0] != ''){
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0], 'jpeg'))
            {
                $extension = 'jpg';
            }
            else{
                $extension = 'png';
            }
            $fileName = str_random().'.'.$extension;
            $path = public_path().'/img/labs/'.$fileName;
            file_put_contents($path, $decoded);
        }
        else{
            $fileName = null;
        }

        $lab->laboratoy_real_id = $request->laboratoy_real_id;
        $lab->school_campus_name = $request->school_campus_name;
        $lab->name = $request->name;
        $lab->number_work_posts = $request->number_work_posts;
        $lab->area_m2 = $request->area_m2;
        $lab->workgroup = $request->workgroup;
        $lab->lab_img_path = $fileName;
        $lab->created_at = Carbon::now();
        $lab->updated_at = Carbon::now();
        
        $lab->save();

        return new LaboratoriesResource($lab); 
    }

    public function editLab(Request $request, $id) {

        $lab = Laboratories::findOrFail($id);

        $request->validate([
            'laboratoy_real_id' => 'required|unique:laboratories,laboratoy_real_id,'.$lab->id,
            //'campus_id' => Rule::in(['1','2','3','4','5','6']),
            'school_campus_name' => 'required|string',
            'name' => 'required|string',
            'number_work_posts' => 'required|integer',
            'area_m2' => 'required|numeric|between:0,999.99',
            'workgroup' => 'required',
            'lab_img_path' => 'nullable' 
        ]);

        $currentPhoto = $lab->lab_img_path;

        if($request->lab_img_path != $currentPhoto){
            $name = time().'.'. explode('/', explode(':', substr
            ($request->lab_img_path, 0, strpos($request->lab_img_path, ';')))[1])[1];
        
            \Image::make($request->lab_img_path)->save(public_path
            ('img/labs/').$name);

            $request->merge(['lab_img_path' => $name]);

            $labPhoto = public_path('img/labs/').$currentPhoto;

            if(file_exists($labPhoto)){
                @unlink($labPhoto);
            }
        }
        
        $lab->update($request->all());
    }

    public function deleteLab($id){

    	$lab = Laboratories::findOrFail($id);
 
        $lab->delete();
    
        return new LaboratoriesResource($lab);
    }

    public function search(){
        if($search = \Request::get('q')){
            $labs = Laboratories::where(function($query)use($search){
                $query->orWhere('laboratoy_real_id', 'LIKE', "%$search%")
                      //->orWhere('campus_id', 'LIKE', "%$search%")
                      ->orWhere('school_campus_name', 'LIKE', "%$search%")
                      ->orWhere('name', 'LIKE', "%$search%")
                      ->orWhere('number_work_posts', 'LIKE', "%$search%")
                      ->orWhere('area_m2', 'LIKE', "%$search%")
                      ->orWhere('workgroup', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $labs = Laboratories::all();    
        }

        return $labs;
    }
}


