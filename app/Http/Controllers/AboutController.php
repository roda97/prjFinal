<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use App\About;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function getAbout($id)
    {
        return About::find($id);
    }

    public function editAbout(Request $request, $id)
    {

        $about = About::findOrFail($id);

        $request->validate([
            'text' => 'required',
        ]);

        $about->update($request->only(['text']));
        
    }
}
