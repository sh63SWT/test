<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Tool\Sms\SendTemplateSMS;
use Illuminate\Http\Request;
use App\Http\Requests\regRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //注册1：显示注册页面
    public function registerForm()
    {
        //加载视图
        return view('home.register');
    }

    //注册2：生成手机验证码
    public function getCode()
    {
        $charset = '0123456789';
        $post = strlen($charset) - 1;
        $code = '';
        for ($i = 0; $i < 4; $i ++) {
            $code .= $charset[mt_rand(0,$post)];
        }
        return $code;
    }

    //注册3：发送手机验证码
    public function sendSms(Request $request)
    {
        //发送手机验证码
        $code = $this->getCode();
        //如何将验证码保存?
        $request->session()->put('phonecode',$code);
        //实例化对象
        $sms = new SendTemplateSMS();
        var_dump($code);
       $result = $sms->send($request->phone,array($code,5),1);//(测试时暂时关闭发送手机验证码)
        //5分钟
        //当前时间加上五分钟的时间戳
        //超过时间修改验证码
        //保存到数据库中，单独设计一种表
        //temphone:id主键，phone：手机号，code：手机验证码，datetime：过期时间
        //判断是否已经存在了，已经存在修改验证码的值，如果没有添加进去
       return $result->toJson();//(测试时暂时关闭返回结果)
    }

    //注册4：执行最后注册过程
    public function regval(Request $request)
    {
        $rules = [
            'phone' => 'required|min:11|unique:users|numeric',
            'name' => 'required|min:2|max:12',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:6,32|alpha_dash',
            'repass' => 'required|between:6,32|alpha_num',
            'code' => 'required|min:4|numeric',
        ];
        $messages = [
            'phone.required' => '*手机号不能为空',
            'phone.min' => '*手机号长度11位',
            'phone.unique' => '*该手机号已被注册',
            'phone.numeric' => '*该手机号要数字',
            'name.required' => '*用户名不能为空',
            'name.min' => '*用户名不能小于2位',
            'name.max' => '*用户名不能大于12位',
            'email.required' => '*邮箱不能为空',
            'email.email' => '*邮箱格式不正确',
            'email.unique' => '*邮箱已被使用',
            'password.required' => '*密码不能为空',
            'password.between' => '*密码长度6-32位',
            'password.alpha_dash' => '*密码仅包含字母、数字、破折号（ - ）以及下划线（ _ ）',
            'repass.required' => '*确认密码不能为空',
            'repass.between' => '*密码长度6-32位',
            'repass.alpha_num' => '*密码需要数字和字母组成',
            'code.required' => '*验证码不能为空',
            'code.min' => '*验证码长度4位',
            'code.numeric' => '*验证码只能是数字',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();
        //没有validate就需要以下手动验证
        /*if ($validator->fails()) {
            return redirect('/home/register')
                ->withErrors($validator)
                ->withInput();
        }*/
        //获取接收到表单里的验证码
        $newcode = $request->code;
        // 获取原先的验证码
        $oldcode = Session::get('phonecode');
        //匹配验证码
        if($oldcode == $newcode)
        {
            //注册成功后，返回一个状态和信息
//            $result=DB::
//            dd($request->all());
            $regtime = date('Y-m-d H:i:s',time());
            $result = User::create(array_merge($request->all(),['regtime' => $regtime]));
//            User::create($request->all());//使用all方式以数组格式获取所有输入值
            return json_encode(array('status' => 0, 'mess' => '注册成功'));
        }else{
            return json_encode(array('status' => 1, 'mess' => '注册失败'));
        }
    }

    //登录1：显示登录页面
    public function loginForm()
    {
        return view('home.login');
    }

    //登录2：验证手机号是否可以登录
    public function logintel(Request $request){
        //获取当前手机号是否存在
        $result = DB::table('users')->where('phone',$request->phone)->get()->first();
        //存在继续判断
        if($result){
            $sta = DB::table('users')->where('phone',$request->phone)->get()->first()->status;
            if($sta == 2){
                return json_encode(array('status'=>3,'mess'=>'被禁用'));
            }else{
                return json_encode(array('status'=>1,'mess'=>'验证通过'));
            }

        }else{
            return json_encode(array('status'=>2,'mess'=>'验证失败'));
        }

    }

    //登录3：验证验证码
    public function logincap(Request $request){
        $rules = [
            'captcha' => 'captcha',
        ];
        $messages = [
            'captcha.captcha' => '*验证码错误',
        ];
        $result = Validator::make($request->all(), $rules, $messages)->validate();
        return json_encode(array('status'=>1,'mess'=>'验证通过'));
    }

    //登录4：执行最后登录过程
    public function tologin(Request $request)
    {
        $rules = [
            'captcha' => 'required|captcha',
        ];
        $messages = [
            'captcha.required' => '*验证码不能为空',
            'captcha.captcha' => '*验证码错误',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        //获取当前手机号是否存在
        $result = DB::table('users')->select('id')->where('phone',$request->phone)->get()->first();
        //存在继续判断
        if($result){
            //判断用户状态
            $sta = DB::table('users')->where('phone',$request->phone)->get()->first()->status;
            if($sta == 2){
                return json_encode(array('status'=>3,'mess'=>'被禁用'));
            }else{
                if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                    $request->session()->put('phone',$request->phone);
                    //{{Auth::guard()->user()->name}}已经是默认放入user中了
                    $request->session()->put('uid',$result);
                    return json_encode(array('status' => 0, 'mess' => '登录成功'));
                } else {
                    return json_encode(array('status' => 1, 'mess' => '密码错误'));
                }
            }
        }else{
            return json_encode(array('status'=>2,'mess'=>'手机号不存在'));
        }

    }

    //处理用户退出登录
    public function logout()
    {
        Auth::guard()->logout();
        return redirect('/home/login');
        //dd(Auth::guard('admin')->user());
    }

    //个人中心验证
    public function vipUpdate(Request $request){
        $uphone = Session::get('phone');
        $uid = Session::get('uid');
        $users = DB::table('users')->where('phone',$uphone)->first();
        //$request->session()->put('uid',$users->id);
        return view('home.userUpdate',compact('users'));
    }

    //个人中心数据验证
    public function tovipUpdate(UserRequest $request){
        $id = $request->uid;//获取用户id
        //当前用户的邮箱
        $oldemail = DB::table('users')->where('id',$id)->first()->email;
        //表单获取到的邮箱
        $newemail = $request->email;
        //根据获取的邮箱去查找数据库的邮箱
        $emails = DB::table('users')->where('email',$newemail)->get()->first();
        //1.自己的 2.没有人
        if($newemail == $oldemail || empty($emails)){
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
                return redirect('/home/vipUpdate');
            }else{
                return back();
            }
        }else{
            return back();
        }
    }
}
