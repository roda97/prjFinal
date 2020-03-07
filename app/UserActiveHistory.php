<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActiveHistory extends Model 
{
    protected $fillable = [
        'user_id',
        'name',
        'changed_to',
        'created_at'
    ];

}