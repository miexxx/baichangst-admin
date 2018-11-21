<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24/024
 * Time: 20:25
 */

namespace App\Admin\Controllers\Mess;

use App\Http\Controllers\Controller;
use App\Models\Mess;
use App\Models\Category;
use Illuminate\Http\Request;
/**
 * @module 新闻列表管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class NewController extends  Controller
{
    /**
     * @permission 新闻列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $header = '新闻管理';
        $news = Mess::orderBy('created_at','desc')->paginate(10);
        $data = request()->all();
        return view('admin::new.news',compact('news','data','header'));
    }

    /**
     * @permission 新闻创建-页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $categorys = Category::all();
        return view('admin::new.new-create',compact('categorys'));
    }

    /**
     * @permission 新闻编辑-页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($new){
        $categorys = Category::all();
        $new = Mess::where('id','=',$new)->first();
        return view('admin::new.new-edit',compact('new','categorys'));
    }


    /**
     * @permission 新闻创建
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request){
        //验证

        $this->validate($request, [
            'title' => 'required|max:100',
            'content' => 'required',
            'image'=>'required',
            'host' => 'required',
            'category_id' =>'required',
        ]);

        //逻辑
        $new = new Mess();
        $new->title= $request->get('title');
        $new->content=$request->get('content');
        $new->host=$request->get('host');
        $new->category_id =$request->get('category_id');
        //存入图片，视频

        $path = $request->file('image')->store('image', 'public');
        $new->image = getenv('APP_URL').'/app/public/'.$path;
        //
        $new->save();
        //渲染
        return redirect()->route('admin::news.index');
    }


    /**
     * @permission 新闻修改
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($new,Request $request){

        $new =(new Mess)->where('id','=',$new)->first();

        //验证
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|min:30',
            'host' => 'required',
            'category_id' =>'required',
        ]);

        //逻辑
        $new->title= $request->get('title');
        $new->content=$request->get('content');
        $new->host=$request->get('host');
        $new->category_id =$request->get('category_id');
        //存入图片，视频
        if($request->file('image')) {
            $path = $request->file('image')->store('image', 'public');
            $new->image = getenv('APP_URL') . '/app/public/' . $path;
        }
        //
        $new->save();
        //渲染
        return redirect()->route('admin::news.index');

    }


    /**
     * @permission 新闻删除
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy($new){
        $new = Mess::where('id','=',$new)->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    public function news($id){
        $new = (new Mess())->where('category_id','=',$id)->orderBy('created_at','desc')->paginate(10);
        return response()->json($new);
    }

    public function show($new){
        $new = Mess::where('id','=',$new)->first();
        $new->views+=1;
        $new->save();
        return response()->json($new);
    }


}