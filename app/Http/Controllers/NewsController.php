<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getAll()
    {
        return NewsResource::collection(News::all());
    }

    public function getNew($id)
    {
        return News::find($id);
    }

    public function deleteNew($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return new NewsResource($news);
    }

    public function createNew(Request $request)
    {

        $request->validate([
            'author' => 'required',
            'title' => 'required|unique:news,title',
            'text' => 'required',
            'description' => 'required',
            'new_img_path' => 'nullable' 
        ]);

        $news = new News();

        $news->author = $request->author;
        $news->title = $request->title;
        $news->text = $request->text;
        $news->description = $request->description;
        $news->created_at = Carbon::now();
        $news->updated_at = Carbon::now();

        $exploded = explode(',', $request->new_img_path);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg'))
        {
            $extension = 'jpg';
        }
        else{
            $extension = 'png';
        }
        $fileName = str_random().'.'.$extension;
        $path = public_path().'/img/news/'.$fileName;
        file_put_contents($path, $decoded);

                $news->new_img_path = $fileName;

        $news->save();

        return new NewsResource($news);
    }

    public function editNew(Request $request, $id)
    {

        $news = News::findOrFail($id);

        $request->validate([
            'text' => 'required',
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);


        $news->update($request->only(['text', 'title', 'author', 'description']));
        
    }

    public function alterStatus($id)
    {

        $news = News::findOrFail($id);
        $news->save();
        return new NewsResource($news);

    }

    public function search(){
        if($search = \Request::get('q')){
            $news = News::where(function($query)use($search){
                $query->where('title', 'LIKE', "%$search%")
                      ->orWhere('author', 'LIKE', "%$search%")
                      ->orWhere('created_at', 'LIKE', "%$search%");
            })->get();
        }
        else
        {
            $news = News::all();    
        }

        return $news;
    }

}
