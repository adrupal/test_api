<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'type',
        'uid',
        'mobile',
        'username',
        'country',
        'state',
        'city',
        'district',
        'address1',
        'address2',
        'apartment',
        'zipCode',
        'addr_default'
    ];

}
