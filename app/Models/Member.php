<?php

namespace App\Models;
use Tanmo\Search\Traits\Search;
use Illuminate\Database\Eloquent\Model;
class Member extends Model
{

    use Search;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "members";


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
