<?php

namespace App\Admin\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
/**
 * @module 关于我们
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class AboutController extends Controller
{
    /**
     * @permission 关于我们内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '关于我们';
        $about =About::first();
        return view('admin::about.about',compact('about','header'));
    }

    /**
     * @permission 更新内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(About $about,Request $request){
        //验证
        $this->validate($request, [
            'title' => 'required|max:50',
            'detail' => 'required|max:100',
            'tel' => 'required|max:50',
            'email'=>'required',
            'postcode'=>'required',
            'address'=>'required',
            'host'=>'required',
        ]);
        //逻辑
        $about->title = $request->get('title');
        $about->detail= $request->get('detail');
        $about->tel = $request->get('tel');
        $about->email = $request->get('email');
        $about->postcode = $request->get('postcode');
        $about->address = $request->get('address');
        $about->host = $request->get('host');
        $about->save();
        //渲染
        return redirect()->route('admin::about.index');
    }

    public function show(){
        $about =About::first()->get(['title','detail','tel','email','postcode','address']);
        return response()->json($about);
    }
}