<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model 
{
    protected $fillable = [
        'author',
        'title',
        'text',
        'description',
        'created_at',
        'status',
    ];

}