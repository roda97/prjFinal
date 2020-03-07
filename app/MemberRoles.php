<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRoles extends Model
{
    protected $table ="user_roles";

    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
