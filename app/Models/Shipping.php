<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping_charges';
    protected $fillable = ['country_id', 'amount'];
}
