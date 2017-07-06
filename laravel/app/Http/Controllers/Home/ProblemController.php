<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\ProblemRequest;
use App\Models\Problem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProblemController extends Controller
{
    //提交密码
    public function getAnswer(ProblemRequest $request){
        $data = $request->all();
        $uid = $request->all()['uid'];
        $answer = $request->all()['answer'];
        $problem = $request->all()['problem'];
        $results = DB::table('problems')->where('uid',$uid)->first();//查看表是否有数据
        if ($results){
            $datas = ['uid'=>$uid,'answer'=>$answer,'problem'=>$problem];
            $dd = DB::table('problems')->where('uid',$uid)->update($datas);
        }else{
            $dd = Problem::create($request->all());
        }
        if($dd){
            return back();
        }else{
            return redirect('/home/vipUpdate');
        }
    }

    //显示
    public function forgetPass(){

        return view('home.forgetPass');
    }

    public function getproblem(ProblemRequest $request){
        //获取表单中的答案
        $newpro = $request->all()['problem'];
        //获取表格中的答案
        $phone = $request->all()['phone'];
        $uid = DB::table('users')->select('id')->where('phone',$phone)->first()->id;
        $oldpro = DB::table('problems')->select('problem')->where('uid',$uid)->first()->problem;
        //如果新旧答案一致，则重置用户密码
        if($newpro == $oldpro){
            $value = '123456';
            $values = Hash::make($value);
            $data=['password'=>$values];
            $update = DB::table('users')->where('id',$uid)->update($data);
            return json_encode(array('status' => 1, 'mess' => $value));
        }else{
            return json_encode(array('status' => 2, 'mess' => '答案不正确'));
        }
        dd($oldpro);
    }

    //根据手机号码显示问题
    public function gettel(Request $request){
        $result = DB::table('users')->select('id')->where('phone',$request->phone)->get();
        $uid = $result->first()->id;
        $res = DB::table('problems')->select('answer','problem')->where('uid',$uid);
        if(empty($res->first()->answer))
        {
            return json_encode(array('status' => 2, 'mess' => '您没有找回功能'));
        }else{
            $mess = $res->first()->answer;
            return json_encode(array('status' => 1, 'mess' => $mess));
        }
    }
}
