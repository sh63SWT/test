<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUpRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //显示登录表单
    public function loginForm()
    {
        return view('admin.login');
    }
    //处理用户登录信息
    public function doLogin(AdminRequest $request)
    {
        //通过哈希验证数据

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))  {
            //判断用户是否登陆成功存入session
            //$request->session()->put('admin',$request->username);
            return view('admin.index');
        } else {
            return '登录失败';
        }
    }

    //处理用户退出登录
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
        //dd(Auth::guard('admin')->user());
    }

    //管理员列表
    public function adminList()
    {
        $admins = DB::table('admins')->orderBy('status')->paginate(5);//分页
        $result_sta = Auth::guard('admin')->user()->status;
        $result_id = Auth::guard('admin')->user()->id;
        return view('admin.administrator.adminList',compact('admins','result_sta','result_id'));
    }

    //管理员添加页面
    public function adminToAdd()
    {
        $result_sta = Auth::guard('admin')->user()->status;
//        $result_id = Auth::guard('admin')->user()->id;
        return view('admin.administrator.admintoAdd',compact('result_sta'));
    }

    //管理员添加
    public function adminAdd(AdRequest $request)
    {
        //Admin::create($request->all());//使用all方式以数组格式获取所有输入值
        $result = Admin::create($request->all());
        if ($result)
        {
            return redirect('/admin-list');
        }else{
            return back();
        }
    }

    //管理员修改页面
    public function adminToUpdate(Request $request)
    {
        $adminUp = DB::table('admins')->where('id',$request->id)->get()->first();
        $result_sta = Auth::guard('admin')->user()->status;
        return view('admin.administrator.admintoUpdate',compact('adminUp','result_sta'));
    }

    //管理员修改
    public function adminUpdate(AdminUpRequest $request, $id)
    {
        //$result = Admin::where('id', $id)->first()->update($request->all());
        //当前用户的邮箱
        $oldemail = DB::table('admins')->where('id',$id)->get()->first()->email;
        //表单获取到的邮箱
        $newemail = $request->email;
        //根据获取的邮箱去查找数据库的邮箱
        $emails = DB::table('admins')->where('email',$newemail)->get()->first();
        //1.自己的 2.没有人
        if($newemail == $oldemail || empty($emails)){
            //更新数据
            $result =Admin::find($id)->update($request->all());
            if ($result)
            {
                return redirect('/admin-list');
            }else{
                return back();
            }
        }else{
            return back();
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
        $emails = DB::table('admins')->where('email',$newemail)->get()->first();
        if ($emails){
            return json_encode(array('status' => 1, 'mess' => '*邮箱可以登录'));
        }else{
            return json_encode(array('status' => 0, 'mess' => '*邮箱不可以登录'));
        }
    }

    //管理员删除
    public function adminDelete(Request $request){
        $result = DB::table('admins')->where('id',$request->id)->delete();
        if($result)
        {
            return back();
        }else {
            return '删除失败';
        }
    }

}
