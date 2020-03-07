<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model 
{
    protected $fillable = [
        'title',
        'keywords',
        'scientific_domains',
        'application_domains',
        'updated_at'
    ];

}