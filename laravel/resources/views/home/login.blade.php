<!DOCTYPE html>
<html>
<head>
    <title>堆糖，美好生活研究所</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/home/login2.css') }}">
    <link href="{{ URL::asset('css/home/login.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/public/jquery-1.8.3.min.js') }}"></script>
</head>
<body>
<div id="content">
    <div class="pg-main" style="background-image: url({{URL::asset('img/home/1.jpg')}}">
        <div class="pg-header">
            <div class="pg-head">
                <a class="pg-home" href="https://www.duitang.com/">
                    {{--<img class="pg-logo" src="./logo3.png" alt="logo">--}}
                </a>
                <div class="pg-logbtns">
                    <a class="pg-reg" href="/home/register">注册</a>
                    <span>|</span>
                    <a class="pg-log active"  href="/home/login">登录</a>
                </div>
            </div>
        </div>
        <div class="pg-content">
            <div class="pg-wrapbox">
                <div class="pg-box clr">
                    <div class="l">
                        <form class="form pg-form-login clr" action="" method="post">
                            {{csrf_field()}}
                            <ul class="pg-infobox l">
                                <li>
                                    <input placeholder="请输入手机号码" id="phone" type="text" name="phone" maxlength="11">
                                    <span id="phonecode" class="reg-tips"></span>
                                </li>
                                <li>
                                    <input placeholder="请输入密码" id="password" type="password" name="password">
                                    <span id="passcode" class="reg-tips"></span>
                                </li>
                                <li>
                                    <div class="codes">
                                        <div class="codeleft">
                                            <input placeholder="输入验证码" maxlength="4" id="captcha" class="pg-vali" type="text" name="captcha">
                                            <span id="capcode" class="reg-tips"></span>
                                        </div>
                                        <div class="coderight">
                                            {{--bootstap自带的验证码--}}
                                            <i class="pg-tip-icon"><img src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}?'+Math.random()"></img>
                                        </div>
                                    </div>
                                    @if(count($errors)>0)
                                        <p>{{$errors->first('captcha')}}</p>
                                    @endif
                                </li>
                                <li>
                                    <div class="clr u-chk">
                                        {{--<input id="login-rem" class="chk l pg-chb" type="checkbox" name="remember">--}}
                                        {{--<label for="login-rem" class="l">记住我</label>--}}
                                        <a class="pg-fog r" href="/home/forgetpass">忘记密码？</a>
                                    </div>
                                    <span class="pg-reg-bottom"></span>
                                </li>
                                <li>
                                    <div class="pg-submits clr">
                                        <a href="javascript:;" class="abtn pg-lgbtn">
                                            <button type="submit"><u>登录</u></button>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </form>
                        <div class="pg-reg-log">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="win-house" class="h0">
    <h1 class="loginerror"></h1>
</div>
<div id="foot-forms" class="dn">
</div>
<script>
    $(function () {
        $('#captcha').blur(function () {
            var captcha = $("#captcha").val();
            if (captcha.length == 0){
                $("#capcode").html('*验证码不能为空');
                return false;
            }
            if (captcha.length < 4){
                $("#capcode").html('*验证码不能小于4位');
                return false;
            }else{
                $("#capcode").html('');
                return false;
            }
        })
        $('#password').blur(function () {
            var password = $("#password").val();
            if (password.length == 0){
                $("#passcode").html('*密码不能为空');
                return false;
            }
            if (password.length < 6){
                $("#passcode").html('*密码不能小于6位');
                return false;
            }else{
                $("#passcode").html('');
                return false;
            }
        })
        $('#phone').blur(function () {
            var phone = $("#phone").val();
            if (phone.length == 0){
                $("#phonecode").html('*手机号码不能为空');
                return false;
            }
            if (phone.length < 11){
                $("#phonecode").html('*手机号码长度不正确');
                return false;
            }
            $.ajax({
                url:'/home/logintel',
                type:'get',
                data:{
                    'phone':phone,
                },
                success:function (data,status,xhr) {
                    if (data.status == 1){
                        $("#phonecode").html('*该手机号可以登录');
                    }
                    if (data.status == 2){
                        $("#phonecode").html('*该手机号没有注册');
                        return false;
                    }
                    if (data.status == 3){
                        $("#phonecode").html('*该手机号已被禁用');
                        return false;
                    }
                },
                dataType:'json',
            });
            return false;
        })
        $("form").submit(function (){
            var phone = $("#phone").val();
            var password = $("#password").val();
            var captcha = $('#captcha').val();
            $.ajax({
                url:'/home/tologin',
                type:'post',
                data: {
                    'phone': phone,
                    'password': password,
                    'captcha':captcha,
                    '_token':"{{csrf_token()}}",
                },
                success:function (data,status,xhr) {
                    if (data.status == 0) {
                        location.href = '{{url('/home/vipUpdate')}}';
                    }
                    if (data.status == 1) {
                        alert('密码错误');
                        location.href = location.href;
                    }
                    if (data.status == 2) {
                        alert('手机号码没有注册');
                        location.href = location.href;
                    }

                },
                error:function (xhr,status,message) {
                    eval("var errors ="+ xhr.responseText);
                    if (errors.captcha) {
                        $("#capcode").html(errors.captcha[0]);
                    }else{
                        $("#capcode").html('');
                    }
                },
                dataType:'json',
            });
            return false;
        })
    })
</script>
</body>
</html>