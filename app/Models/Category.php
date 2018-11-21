<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24/024
 * Time: 17:07
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorys";

    public function news(){
        $this->hasMany(Mess::class);
    }
}