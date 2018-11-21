<?php

namespace App\Admin\Controllers\Appinfo;

use App\Http\Controllers\Controller;
use App\Models\Appinfo;
use Illuminate\Http\Request;

/**
 * @module APP图文信息管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class AppinfoController extends Controller
{
    /**
     * @permission App图文信息列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = 'App图文管理';

        $appinfos = (new Appinfo())->orderBy('sort','desc')->orderBy('created_at','desc')->get();
        $count = Appinfo::count();
        return view('admin::appinfo.appinfos',compact('appinfos','header','count'));
    }

    public function create(){
        if(Appinfo::count()<4) {
            return view('admin::appinfo.appinfo-create');
        }
        else{
            return redirect()->route('admin::appinfos.index');
        }
    }

    public function destroy(Appinfo $appinfo){
        $appinfo->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    public function edit(Appinfo $appinfo){
        return view('admin::appinfo.appinfo-edit',compact('appinfo'));
    }

    public function store(Request $request){
        //验证
        if(Appinfo::count()>=4) {
            return redirect()->route('admin::appinfos.index');
        }
        $this->validate($request, [
            'title' => 'required|max:20',
            'image'=>'required',
            'content'=> 'required',
            'sort' =>'required|integer',
        ]);

        //逻辑
        $appinfo = new Appinfo();
        $appinfo->title= $request->get('title');
        $appinfo->content= $request->get('content');
        $appinfo->sort= $request->get('sort');
        //存入图片，视频

        $path = $request->file('image')->store('image', 'public');
        $appinfo->image = getenv('APP_URL').'/app/public/'.$path;
        //
        $appinfo->save();
        //渲染
        return redirect()->route('admin::appinfos.index');
    }

    public function update(Request $request,Appinfo $appinfo){
        //验证

        $this->validate($request, [
            'title' => 'required|max:20',
            'content'=> 'required',
            'sort' =>'required|integer',
        ]);

        //逻辑
        $appinfo->title= $request->get('title');
        $appinfo->content =$request->get('content');
        $appinfo->sort= $request->get('sort');
        //存入图片，视频
        if($request->file('image')) {
            $path = $request->file('image')->store('image', 'public');
            $appinfo->image = getenv('APP_URL') . '/app/public/' . $path;
        }
        $appinfo->save();
        //渲染
        return redirect()->route('admin::appinfos.index');
    }

    public function show(){
        $appinfos = (new Appinfo())->orderBy('sort','desc')->orderBy('created_at','desc')->get(['image','content','title']);
        return response()->json($appinfos);
    }


}