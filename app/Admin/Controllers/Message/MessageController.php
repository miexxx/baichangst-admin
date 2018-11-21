<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24/024
 * Time: 9:14
 */
namespace App\Admin\Controllers\Message;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 在线加盟管理
 *
 * Class MemberController
 * @package App\Admin\Controllers\Message
 */
class MessageController extends Controller
{
    /**
     * @permission 加盟申请列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $header = '在线加盟申请管理';
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->like('name');
            $searcher->equal('tel');
        });
        $messages= (new Message())->search($searcher)->orderBy('created_at','desc')->paginate(10);

        $data = request()->all();
        return view('admin::message.messages',compact('messages','data','header'));
    }

    /**
     * @permission 加盟申请
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request){

        //验证
        $data =[
            'state' => '0',
            'msg' => '提交失败'
        ];
        if($request->get('name')&&$request->get('sex')&&$request->get('tel')&&$request->get('type')&&$request->get('address')) {
            $message = new Message();
            $message->name = $request->get('name');
            if($request->get('sex')!='男'&& $request->get('sex')!='女'){
                return response()->json($data);
            }
            $message->sex =$request->get('sex');
            $message->tel = $request->get('tel');
            $message->type = $request->get('type');
            $message->address = $request->get('address');
            $message->save();
            $data['state'] = '1';
            $data['msg'] = '提交成功';
        }


        return response()->json($data);
    }


    /**
     * @permission 删除申请列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Message $message){
        $message->delete();
        return response()->json(['status' => 1, 'message' => '成功']);
    }

    /**
     * @permission 查看申请内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Message $message){
        $message->state = 1;
        $message->save();
        return view('admin::message.message-show',compact('message'));
    }

}