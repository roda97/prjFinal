<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Privileges extends Model
{
    public $table = "cv_privileges";
    protected $fillable = [
        'user_science_id',

        'api_user_name',
        'api_user_privacy_level_code',
        'api_user_privacy_level_value',
        'api_user_role_code',
        'api_user_role_value',

        'api_user_url',
        'privilege_ciencia_id',
        'privilege_effective_privacy_level_code',
        'privilege_effective_privacy_level_value',
        'privilege_effective_role_code',
        'privilege_effective_role_value',
    ];
}
