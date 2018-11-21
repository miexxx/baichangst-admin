<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/4/14
 * Time: 16:02
 * Function:
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/**
 * @module 动画视频管理
 *
 * Class MovieController
 * @package App\Admin\Controllers
 */
class MovieController extends Controller
{
    /**
     * @permission 显示动画
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return view('admin::base.movie');
    }

    public function update(Request $request){
       if($request->hasFile('movie')){
           $path =  Storage::disk('public')->url($request->file('movie')->store('movie', 'public'));
           edit_env(['MOVIE_PATH' => $path]);
       }
       return redirect()->route('admin::movie.show');
    }

    public function index(){
        return response()->json(getenv('MOVIE_PATH'));
    }

 

}