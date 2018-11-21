<?php

namespace App\Admin\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 职位管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class PositionController extends Controller
{
    /**
     * @permission 职位列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '职位管理';
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->like('endtime');
            $searcher->like('title');
        });
        $positions = (new Position)->search($searcher)->orderBy('created_at','desc')->paginate(10);
        $data = request()->all();
        return view('admin::position.positions',compact('positions','data','header'));
    }

    /**
     * @permission 职位创建-页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin::position.position-create');
    }

    /**
     * @permission 职位创建
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        //验证

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'need'=>'required|integer',
            'endtime' => 'required',
        ]);

        //逻辑
        $position = new Position();
        $position->title= $request->get('title');
        $position->content=$request->get('content');
        $position->need=$request->get('need');
        $position->endtime =$request->get('endtime');

        //
        $position->save();
        //渲染
        return redirect()->route('admin::positions.index');
    }

    /**
     * @permission 职位编辑-页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Position $position)
    {
        return view('admin::position.position-edit',compact('position'));
    }

    /**
     * @permission 职位修改
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, Position $position)
    {
        //验证

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|min:30',
            'need'=>'required|integer',
            'endtime' => 'required',
        ]);

        //逻辑
        $position->title= $request->get('title');
        $position->content=$request->get('content');
        $position->need=$request->get('need');
        $position->endtime =$request->get('endtime');

        //
        $position->save();
        //渲染
        return redirect()->route('admin::positions.index');
    }

    /**
     * @permission 职位删除
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    public function positions(){
        $positions =  (new Position)->orderBy('created_at','desc')->get(['id','title','need','content','endtime']);
        return response()->json($positions);
    }

}