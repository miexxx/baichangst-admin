<?php

namespace App\Models;
use Tanmo\Search\Traits\Search;
use Illuminate\Database\Eloquent\Model;
class Message extends Model
{

    use Search;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "messages";


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
