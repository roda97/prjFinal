<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembersScientificCommittee extends Model
{
    protected $fillable = [
        'user_id',
        'scientific_committees_id'
    ];
}
