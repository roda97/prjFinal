<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Departments extends Model 
{
    protected $fillable = [
        'name',
        'initials'
    ];

    public function users(){

    	return $this->hasMany(User::class);
    }

}