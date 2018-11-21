<?php

namespace App\Admin\Controllers\Foot;

use App\Http\Controllers\Controller;
use App\Models\Foot;
use Illuminate\Http\Request;
/**
 * @module foot管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class FootController extends Controller
{
    /**
     * @permission foot列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = 'foot列表';
        $foots =(new Foot())->orderBy('created_at','desc')->get();
        return view('admin::foot.foots',compact('foots','header'));
    }

    public function create(){
        return view('admin::foot.foot-create');
    }
    public function edit(Foot $foot){
        return view('admin::foot.foot-edit',compact('foot'));
    }

    public function destroy(Foot $foot){
        $foot->delete();
        return redirect()->route('admin::foots.index');
    }

    public function store(Request $request){
        //验证

        $this->validate($request, [
            'title' => 'required|max:20',
            'url'=>'required',
           'type'=>'required|integer',
        ]);

        //逻辑
        $foot = new Foot();
        $foot->title = $request->get('title');
        $foot->url = $request->get('url');
        $foot->type = $request->get('type');
        $foot->save();

        return redirect()->route('admin::foots.index');

    }


    public function update(Request $request,Foot $foot){
        //验证

        $this->validate($request, [
            'title' => 'required|max:20',
            'url'=>'required',
            'type'=>'required|integer',
        ]);

        //逻辑
        $foot->title = $request->get('title');
        $foot->url = $request->get('url');
        $foot->type = $request->get('type');
        $foot->save();

        return redirect()->route('admin::foots.index');
    }

    public function show(){
        $foots = (new Foot())->orderBy('created_at','desc')->get(['title','url','type']);
        return response()->json($foots);
    }

}