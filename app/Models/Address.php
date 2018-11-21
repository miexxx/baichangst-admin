<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Address extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "addresss";
    protected $fillable = [
        'address_id', 'address_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
