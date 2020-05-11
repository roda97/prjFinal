<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamActiveHistory extends Model 
{
    protected $fillable = [
        'team_id',
        'changed_to',
        'created_at',
        'updated_at'
    ];

}