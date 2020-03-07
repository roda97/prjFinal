<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Language_Competency extends Model
{
    public $table = "cv_language_competencies";
    protected $fillable = [
        'user_science_id',

        'language_code',
        'language_value',
        'mother_tongue',
        'read_value',
        'read_code',
        'write_value',
        'write_code',
        'speak_value',
        'speak_code',
        'understand_spoken_value',
        'understand_spoken_code',
        'privacy_level',
        'peer_review'
    ];

}
