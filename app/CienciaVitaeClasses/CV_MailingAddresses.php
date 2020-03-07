<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_MailingAddresses extends Model
{
    public $table = "cv_mailingaddresses";
    protected $fillable = [
        'user_science_id',

        'address_type_value',
        'address_type_code',
        'street_address',
        'postal_code',
        'city',
        'province_state',
        'country_value',
        'last_modified_date',
        'preferred_mailing_address',
        'privacy_level',
    ];

}
