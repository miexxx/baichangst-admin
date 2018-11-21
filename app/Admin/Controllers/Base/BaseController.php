<?php

namespace App\Admin\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base;
use Illuminate\Http\Request;
/**
 * @module 站点配置
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class BaseController extends Controller
{
    /**
     * @permission 站点管理
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '站点配置';
        $base =Base::first();

        return view('admin::base.base',compact('base','header'));
    }

    /**
     * @permission 更新内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Base $base,Request $request){
        //验证

        //逻辑

        $base->cone = $request->get('cone');
        $base->ctwo = $request->get('ctwo');

        $base->stwof = $request->get('stwof');
        $base->stwos = $request->get('stwos');
        $base->stwot = $request->get('stwot');
        $base->stwox = $request->get('stwox');

        $base->cthree = $request->get('cthree');
        $base->cfour = $request->get('cfour');
        $base->cfive = $request->get('cfive');
        $base->csix = $request->get('csix');
        $base->ssixf = $request->get('ssixf');
        $base->ssixs = $request->get('ssixs');
        $base->ssixt = $request->get('ssixt');
        $base->save();
        //渲染
        return redirect()->route('admin::base.index');
    }

    public function show(){
        $base =Base::first()->get(['cone','ctwo','cfour','cfive','csix','stwof','stwos','stwot','stwox','ssixf','ssixs','ssixt']);
        return response()->json($base);
    }
}