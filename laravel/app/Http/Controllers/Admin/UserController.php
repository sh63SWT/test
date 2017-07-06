<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //显示用户列表
    public function userList()
    {
        //查询所有的用户
        $users = DB::table('users')->orderBy('created_at')->paginate(5);//分页
        $result_sta = Auth::guard('admin')->user()->status;
        $result_id = Auth::guard('admin')->user()->id;
        return view('admin.user.userList', compact('users','result_sta','result_id'));
    }

    //添加页面
    public function userToAdd()
    {
        $result_sta = Auth::guard('admin')->user()->status;
        return view('admin.user.usertoAdd',compact('result_sta'));
    }

    //添加用户
    public function userAdd(UserRequest $request)
    {
        $regtime = date('Y-m-d H:i:s',time());
        if ($request->icon){
            $upload = ($request->icon);//获取头像信息
            $info = $upload->store('public');//上传路径
            $result = User::create(array_merge($request->all(),['icon' => $info],['regtime' => $regtime]));
        }
        $result = User::create(array_merge($request->all(),['regtime' => $regtime]));
        if ($result)
        {
            return redirect('/user-list');
        }else{
            return back();
        }
    }

    //ajax请求验证手机号
    public function phones(Request $request){
        //表单获取到的手机号
        $newphone = $request->phone;
        $rules = [
            'phone' => 'required|digits:11',
        ];
        $messages = [
            'phone.required' => '*手机号不能为空',
            'phone.digits' => '*手机号要11位数字',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();//错误
        //根据获取的邮箱去查找数据库的邮箱
        $phones = DB::table('users')->where('phone',$newphone)->get()->first();
        if ($phones){
            return json_encode(array('status' => 1, 'mess' => '*手机号已被使用'));
        }else{
            return json_encode(array('status' => 0, 'mess' => '*手机号可以使用'));
        }
    }

    //验证ajax邮箱
    public function emails(Request $request){
        //表单获取到的邮箱
        $newemail = $request->email;
        $rules = [
            'email' => 'required|email',
        ];
        $messages = [
            'email.required' => '*邮箱不能为空',
            'email.email' => '*邮箱格式不正确',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();//错误
        //根据获取的邮箱去查找数据库的邮箱
        $emails = DB::table('users')->where('email',$newemail)->get()->first();
        if ($emails){
            return json_encode(array('status' => 1, 'mess' => '*邮箱已经使用'));
        }else{
            return json_encode(array('status' => 0, 'mess' => '*邮箱可以使用'));
        }
    }

    //修改状态
    public function status(Request $request,$id,$status)
    {
        if ($status == 1)
        {
            $status = 2;
            $result =User::find($id)->update(array_merge($request->all(),['status' => $status]));
            return back();
        }else{
            $status = 1;
            $result =User::find($id)->update(array_merge($request->all(),['status' => $status]));
            return back();
        }
    }

    //修改页面
    public function update(Request $request)
    {
        $userUp = DB::table('users')->where('id',$request->id)->get()->first();
        $result_sta = Auth::guard('admin')->user()->status;
        return view('admin.user.userUpdate',compact('userUp','result_sta'));
    }

    //用户修改
    public function toUpdate(UserRequest $request, $id)
    {
        //当前用户的邮箱
        $oldemail = DB::table('users')->where('id',$id)->get()->first()->email;
        //表单获取到的邮箱
        $newemail = $request->email;
        //根据获取的邮箱去查找数据库的邮箱
        $emails = DB::table('users')->where('email',$newemail)->get()->first();

        //当前用户的手机
        $oldphone = DB::table('users')->where('id',$id)->get()->first()->phone;
        //表单获取到的手机
        $newphone = $request->phone;
        //根据获取的手机去查找数据库的手机
        $phones = DB::table('users')->where('phone',$newphone)->get()->first();
        //1.自己的 2.没有人
        if(($newemail == $oldemail || empty($emails)) && ($newphone == $oldphone || empty($phones))){
            //更新数据
            if ($request->icon){
                $upload = ($request->icon);//获取头像信息
                $info = $upload->store('public');//上传路径
                $result =User::find($id)->update(array_merge($request->all(),['icon' => $info]));
            }else{
                $result =User::find($id)->update(array_merge($request->all()));
            }
            if ($result)
            {
                return redirect('/user-list');
            }else{
                return back();
            }
        }else{
            return back();
        }

    }

    //删除权限
    public function userDel($id)
    {
        //删除信息
        User::destroy([$id]);
        return back();
    }

}