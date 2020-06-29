<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScientificCommittee extends Model 
{
    protected $fillable = [
        'room','description','datereunion', 'ata'
    ];
    
    public $timestamps = false;

}