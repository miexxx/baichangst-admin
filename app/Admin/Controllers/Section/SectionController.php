<?php

namespace App\Admin\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
/**
 * @module 部门管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class SectionController extends Controller
{
    /**
     * @permission 部门列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '部门管理';

        $sections = (new Section())->orderBy('sort','desc')->orderBy('created_at','desc')->paginate(10);
        $data = request()->all();
        return view('admin::section.sections',compact('sections','header','data'));
    }

    public function create(){

        return view('admin::section.section-create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'contacts'=>'required',
            'tel'=> 'required',
            'sort' =>'required|integer',
            'email'=>'required',
        ]);
        $section = new Section();
        $section->title = $request->get('title');
        $section->contacts = $request->get('contacts');
        $section->tel = $request->get('tel');
        $section->email = $request->get('email');
        $section->sort = $request->get('sort');
        $section->save();
        return redirect()->route('admin::sections.index');
    }
    public function destroy(Section $section){
        $section->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    public function edit(Section $section){
        return view('admin::section.section-edit',compact('section'));
    }

    public function update(Section $section,Request $request){
        $this->validate($request, [
            'title' => 'required',
            'contacts'=>'required',
            'tel'=> 'required',
            'sort' =>'required|integer',
            'email'=>'required',
        ]);
        $section->title = $request->get('title');
        $section->contacts = $request->get('contacts');
        $section->tel = $request->get('tel');
        $section->email = $request->get('email');
        $section->sort = $request->get('sort');
        $section->save();
        return redirect()->route('admin::sections.index');
    }

    public function  show(){
        $sections = (new Section())->orderBy('sort','desc')->orderBy('created_at','desc')->get(['title','contacts','tel','email']);
        return response()->json($sections);
    }

}