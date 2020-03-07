<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Groups extends Model 
{
    public $table = "cv_groups";
    protected $fillable = [
        'user_science_id',

        'fundings_outputs',
        'employments_services'

    ];

}