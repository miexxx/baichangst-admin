<?php

namespace App\Admin\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

/**
 * @module 轮播图管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class BannerController extends Controller
{
    /**
     * @permission 轮播图列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '轮播图管理';

        $banners = (new Banner())->orderBy('sort','desc')->orderBy('created_at','desc')->get();
        $count = Banner::count();
        return view('admin::banner.banners',compact('banners','header','count'));
    }

    public function create(){
        if(Banner::count()<4) {
            return view('admin::banner.banner-create');
        }
        else{
            return redirect()->route('admin::banners.index');
        }
    }

    public function destroy(Banner $banner){
        $banner->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    public function edit(Banner $banner){
        return view('admin::banner.banner-edit',compact('banner'));
    }

    public function store(Request $request){
        //验证
        if(Banner::count()>=4) {
            return redirect()->route('admin::banners.index');
        }
        $this->validate($request, [
            'title' => 'required|max:255',
            'image'=>'required',
            'sort' => 'required|integer',
            'url'=>'required',
        ]);

        //逻辑
        $banner = new Banner();
        $banner->title= $request->get('title');
        $banner->sort= $request->get('sort');
        $banner->url = $request->get('url');
        //存入图片，视频

        $path = $request->file('image')->store('image', 'public');
        $banner->image = getenv('APP_URL').'/app/public/'.$path;
        //
        $banner->save();
        //渲染
        return redirect()->route('admin::banners.index');
    }

    public function update(Request $request,Banner $banner){
        //验证

        $this->validate($request, [
            'title' => 'required|max:255',
            'sort' => 'required|integer',
            'url'=>'required',
        ]);
        //逻辑
        $banner->title= $request->get('title');
        $banner->sort= $request->get('sort');
        $banner->url = $request->get('url');
        //存入图片，视频
        if($request->file('image')) {

            $path = $request->file('image')->store('image', 'public');
            $banner->image = getenv('APP_URL') . '/app/public/' . $path;

        }
        $banner->save();
        //渲染
        return redirect()->route('admin::banners.index');
    }

    public function show(){
        $banners = (new Banner())->orderBy('sort','desc')->orderBy('created_at','desc')->get(['image','url']);
        return response()->json($banners);
    }


}