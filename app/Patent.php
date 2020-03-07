<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patent extends Model 
{
    public $table = "patents";
    protected $fillable = [
        'title',
        'description'
    ];

}