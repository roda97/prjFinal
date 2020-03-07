<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Partners;

class Project extends Model 
{
    protected $fillable = [
        'title',
        'abstract',
        'consortium',
        'funding',
        'proponent',
        'total_budget',
        'ciic_budget'
    ];

    public function partners(){
    	return $this->hasMany(Partners::class);
    }
}