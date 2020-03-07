<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Partners extends Model 
{
    protected $fillable = [
        'name'
    ];

    public function projects(){
    	return $this->hasMany(Project::class);
    }

}