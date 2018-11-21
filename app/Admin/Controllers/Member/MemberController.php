<?php

namespace App\Admin\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Member;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 加盟企业管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Member
 */
class MemberController extends Controller
{
    /**
     * @permission 企业列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $header = '加盟企业管理';
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->like('name');
            $searcher->equal('contacts');
            $searcher->equal('tel');
        });
        $members= (new Member())->search($searcher)->orderBy('sort','desc')->orderBy('created_at','desc')->paginate(10);
        $data = request()->all();
        return view('admin::member.members',compact('members','data','header'));
    }

    /**
     * @permission 新增企业
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $provinces = Address::where('address_id','like','__')->get(['address_id','address_name']);

        return view('admin::member.member-create',compact('provinces'));
    }




    /**
     * @permission 添加企业
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request){

        //验证
        $this->validate($request, [
            'name' => 'required|max:30',
            'contacts' => 'required|max:20',
            'tel' => 'required|max:20',
            'email'=>'required',
            'postcode'=>'required',
            'logo'=>'required',
            'province'=>'required',
            'city'=>'required',
            'county'=>'required',
            'adrdetail'=>'required',
            'sort'=>'required|integer'
        ]);

        //逻辑
        $member = new Member();
        $member->name = $request->get('name');
        $member->contacts = $request->get('contacts');
        $member->tel = $request->get('tel');
        $member->email = $request->get('email');
        $member->postcode = $request->get('postcode');
        $member->adrdetail =$this->getadd($request->get('county')).$request->get('adrdetail');
        $member->adrdetail = str_replace('市辖区', '', $member->adrdetail);
        $member->sort= $request->get('sort');
        //存入图片
        $path = $request->file('logo')->store('image', 'public');
        $member->logo =getenv('APP_URL').'/app/public/' . $path;

        $member->adrcode=$request->get('county');
        if($request->get('xpoint')&& $request->get('ypoint')){
            $member->xpoint=$request->get('xpoint');
            $member->ypoint=$request->get('ypoint');
        }
        $member->save();
        //渲染
        return redirect()->route('admin::members.index');
    }

    /**
     * @permission 编辑企业
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Member $member){
        $provinces = Address::where('address_id','like','__')->get(['address_id','address_name']);
        $adrcode = $member->adrcode;
        $pro =  substr( $adrcode,0,2);
        $citys = Address::where('address_id','like',$pro.'__')->get(['address_id','address_name']);
        $city = substr( $adrcode,0,4);
        $countys = Address::where('address_id','like',$city.'__')->get(['address_id','address_name']);
        $county = substr( $adrcode,0,6);

        $pro = Address::where('address_id','=',$pro)->select(['address_id','address_name'])->first();
        $city = Address::where('address_id','=',$city)->select(['address_id','address_name'])->first();

        $county = Address::where('address_id','=',$county)->select(['address_id','address_name'])->first();



        return view('admin::member.member-edit',compact('member','provinces','citys','countys','pro','city','county'));
    }


    /**
     * @permission 修改企业信息
     *
     * @param Member $member
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Member $member,Request $request){
        //验证
        $this->validate($request, [
            'name' => 'required|max:30',
            'contacts' => 'required|max:20',
            'tel' => 'required|max:20',
            'email'=>'required',
            'postcode'=>'required',
            'province'=>'required',
            'city'=>'required',
            'county'=>'required',
            'adrdetail'=>'required',
            'sort'=>'required|integer'
        ]);
        $add = $this->getadd($member->adrcode);
        $add = str_replace('市辖区', '', $add);
        $member->adrdetail = $request->adrdetail;
        $member->adrdetail = str_replace($add, '', $member->adrdetail);
        //逻辑
        $member->name = $request->get('name');
        $member->contacts = $request->get('contacts');
        $member->tel = $request->get('tel');
        $member->email = $request->get('email');
        $member->postcode = $request->get('postcode');
        $member->adrdetail =$this->getadd($request->get('county')).$member->adrdetail;
        $member->adrdetail = str_replace('市辖区', '', $member->adrdetail);
        $member->sort= $request->get('sort');

        //存入图片
        if($request->file('logo')) {
            $path = $request->file('logo')->store('image', 'public');
            $member->logo = getenv('APP_URL') . '/app/public/' . $path;
        }

        $member->adrcode=$request->get('county');
        if($request->get('xpoint')&& $request->get('ypoint')){
            $member->xpoint=$request->get('xpoint');
            $member->ypoint=$request->get('ypoint');
        }
        $member->save();
        //渲染
        return redirect()->route('admin::members.index');
    }

    /**
     * @permission 删除企业
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Member $member){
        $member->delete();
        return response()->json(['status' => 1, 'message' => '成功']);

    }

    public function logos(){
        $members = (new Member())->orderBy('sort','desc')->orderBy('created_at','desc')->select('logo','name','contacts','tel','adrdetail')->paginate(10);
        return response()->json($members);
    }

    public function check(Request $request){
        $data = [
            'state' => '0',
            'msg' =>'此地区未授权'
        ];
        if($request->get('adrcode')){
            $count = (new Member())->where('adrcode','=',$request->get('adrcode'))->count();
            $member = (new Member())->where('adrcode','=',$request->get('adrcode'))->first();
            $code =$request->get('adrcode');
            if($count) {
                $data['msg'] = "此地区已授权";
                $data['state'] = '1';
                $data['address'] =$member->adrdetail;
                $data['xpoint'] = $member->xpoint;
                $data['ypoint'] = $member->ypoint;
                $data['contacts'] = $member->contacts;
                $data['tel'] = $member->tel;
            }
        }
        return response()->json($data);
    }
    public function getadd($code){
        $procode = substr($code,0,2);
        $citycode = substr($code,0,4);
        $countycode = substr($code,0,6);
        $pro = (new Address())->where('address_id','=',$procode)->first();
        $city = (new Address())->where('address_id','=',$citycode)->first();
        $county = (new Address())->where('address_id','=',$countycode)->first();
        return  $pro->address_name.$city->address_name.$county->address_name;
    }



}