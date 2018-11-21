<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24/024
 * Time: 20:25
 */

namespace App\Admin\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
/**
 * @module 新闻栏目管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class CategoryController extends  Controller
{
    /**
     * @permission 新闻栏目列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $header = '新闻管理';
        $categorys = Category::orderBy('created_at','desc')->paginate(10);
        $data = request()->all();
        return view('admin::category.categorys',compact('categorys','data','header'));
    }

    /**
     * @permission 删除新闻栏目
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Category $category){
        $category->news->delete();
        $category->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }
    /**
     * @permission 创建新闻栏目-页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin::category.category-create');
    }

    /**
     * @permission 编辑新闻栏目-页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category){

        return view('admin::category.category-edit',compact('category'));
    }

    public function update(Category $category,Request $request){
        //验证
        $this->validate($request, [
            'title' => 'required|max:30',
        ]);

        //逻辑
        $category->title = $request->get('title');
        $category->save();
        return redirect()->route('admin::categorys.index');
    }

    /**
     * @permission 创建栏目
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request){
        //验证
        $this->validate($request, [
            'title' => 'required|max:30',
        ]);

        //逻辑
        $category = new Category();
        $category->title = $request->get('title');
        $category->save();
        //渲染
        return redirect()->route('admin::categorys.index');
    }

    public function categorys(){
        $categorys = (new Category())->orderBy('created_at','desc')->select('id','title')->get();
        return response()->json($categorys);
    }
}