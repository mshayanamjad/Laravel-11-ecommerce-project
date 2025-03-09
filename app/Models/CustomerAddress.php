<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country_id',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
        'note',
    ];
}
