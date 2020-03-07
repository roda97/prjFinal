<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnersProjects extends Model 
{
    protected $fillable = [
        'project_id',
        'partner_id'       
    ];

}