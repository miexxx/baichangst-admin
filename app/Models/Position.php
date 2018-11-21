<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24/024
 * Time: 17:07
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Tanmo\Search\Traits\Search;
class Position extends Model
{
    use Search;
    protected $table = "positions";
}