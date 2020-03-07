<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratories extends Model 
{
    protected $fillable = [
        'laboratoy_real_id',
        'school_campus_name',
        'name',
        'number_work_posts',
        'area_m2',
        'workgroup',
        'lab_img_path'
    ];

}