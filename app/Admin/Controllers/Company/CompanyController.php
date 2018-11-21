<?php

namespace App\Admin\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
/**
 * @module 公司简介
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class CompanyController extends Controller
{
    /**
     * @permission 简介内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '公司简介';
        $company =Company::first();

        return view('admin::company.company',compact('company','header'));
    }

    /**
     * @permission 更新内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Company $company,Request $request){

        //逻辑

        $company->content = $request->get('content');
        $company->save();
        //渲染
        return redirect()->route('admin::company.index');
    }

    public function show(){
        $company =Company::first()->get(['content']);
        return response()->json($company);
    }
}