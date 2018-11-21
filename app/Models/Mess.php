<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24/024
 * Time: 17:07
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Mess extends Model
{
    protected $table = "news";

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}