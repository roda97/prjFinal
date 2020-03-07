<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'country_id',
        'postal_code',
        'city',
        'town',
        'street',
        'door_number',
    ];

}
