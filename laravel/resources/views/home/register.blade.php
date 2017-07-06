<!DOCTYPE html>
<html>
<head>
    <title>堆糖，美好生活研究所</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/home/login2.css') }}">
    <link href="{{ URL::asset('css/home/login.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/public/jquery-1.8.3.min.js') }}"></script>
</head>
<body>
<div id="content" style="background-image: url({{URL::asset('img/home/1.jpg')}}">
    <div class="pg-main">
        <div class="pg-header">
            <div class="pg-head">
                <a class="pg-home" href="https://www.duitang.com/">
                    {{--<img class="pg-logo" src="./logo3.png" alt="logo">--}}
                </a>
                <div class="pg-logbtns">
                    <a class="pg-reg active" href="/home/register">注册</a>
                    <span>|</span>
                    <a class="pg-log " href="/home/login">登录</a>
                </div>
            </div>
        </div>
        <div class="pg-content">

            <div class="pg-wrapbox">
                <div class="pg-box clr">
                    <div class="l">
                        <form  class="form pg-form-login clr" action="" method="post">
                            {{csrf_field()}}
                            <ul class="pg-infobox l">
                                <li>
                                    <input id="name" placeholder="请输入用户名" type="text" name="name">
                                    <span id="newsname"class="reg-tips"></span>
                                </li>
                                <li>
                                    <input id="phone" placeholder="请输入手机号" type="text" name="phone" maxlength="11">
                                    <span id="newsphone" class="reg-tips"></span>
                                </li>
                                <li>
                                    <input id="email" placeholder="请输入邮箱地址" type="email" name="name">
                                    <span id="newsemail"class="reg-tips"></span>
                                </li>
                                <li>
                                    <input id="password" placeholder="请输入密码" type="password" name="password">
                                    <span id="newspass" class="reg-tips"></span>
                                </li>
                                <li>
                                    <input id="repass" placeholder="确认密码" type="password" name="repassword">
                                    <span id="newsrepass" class="reg-tips"></span>
                                </li>
                                <li>
                                    <input id="code" placeholder="输入手机验证码" type="text" name="phonecode" maxlength="4">
                                    <span id="newscode" class="reg-tips"></span>
                                </li>
                                <li>
                                    <input type="button" value="获取验证码" id="send_sms" >
                                    <p id="msg"></p>
                                </li>
                                <li>
                                    <div class="pg-submits clr">
                                        <a href="javascript:;" class="abtn pg-lgbtn">
                                            <button  type="submit"><u>注册</u></button>
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
<script type="text/javascript" src="{{ URL::asset('js/public/jquery-1.8.3.min.js') }}"></script>
<script>
    $(function () {
        $("#email").blur(function () {
            var email = $("#email").val();
            if(email == 0){
                $("#newsemail").html('*邮箱不能为空');
                return false;
            }else{
                $("#newsemail").html('');
            }
            $.ajax({
                url:'/user/emails',
                type:'get',
                data:{'email':email},
                success:function (data) {
                    if(data.status == 0)
                    {
                        $("#newsemail").html('*邮箱可以使用');
                    }
                    if(data.status == 1)
                    {
                        $("#newsemail").html('*邮箱已被使用');
                        return false;
                    }
                },
                error:function (xhr,status,message) {
                    eval("var errors ="+ xhr.responseText);
                    if (errors.email) {
                        $("#newsemail").html(errors.email[0]);
                        return false;
                    }else{
                        $("#newsemail").html('');
                    }
                },
                dataType:'json',
            });
            return false;
        })
        $("#phone").blur(function () {
            var phone = $("#phone").val();
            if(phone == 0){
                $("#newsphone").html('*手机号不能为空');
                return false;
            }
            $.ajax({
                url:'/user/phones',
                type:'get',
                data:{'phone':phone},
                success:function (data) {
                    if(data.status == 0)
                    {
                        $("#newsphone").html('*手机号可以使用');
                    }
                    if(data.status == 1)
                    {
                        $("#newsphone").html('*手机号已被使用');
                        return false;
                    }
                },
                error:function (xhr,status,message) {
                    eval("var errors ="+ xhr.responseText);
                    if (errors.phone) {
                        $("#newsphone").html(errors.phone[0]);
                        return false;
                    }else{
                        $("#newsphone").html('');
                    }
                },
                dataType:'json',
            });
            return false;
        })
        $("#name").blur(function () {
            var name = $("#name").val();
            if(name.length == 0){
                $("#newsname").html('*用户名不能为空');
                return false;
            }
            if(name.length < 2){
                $("#newsname").html('*用户名不能小于2');
                return false;
            }else{
                $("#newsname").html('');
            }
        })
        $("#password").blur(function () {
            var password = $("#password").val();
            if(password == 0){
                $("#newspass").html('*密码不能为空');
                return false;
            }
            if(password.length < 6){
                $("#newspass").html('*密码不能小于6');
                return false;
            }else{
                $("#newspass").html('');
            }
        })
        $("#repass").blur(function () {
            var repass = $("#repass").val();
            var password = $("#password").val();
            if(repass == 0){
                $("#newsrepass").html('*密码不能为空');
                return false;
            }
            if(repass.length < 6){
                $("#newsrepass").html('*密码不能小于6');
                return false;
            }
            if(repass != password){
                $("#newsrepass").html('*两次密码不一致');
                return false;
            }else{
                $("#newsrepass").html('');
            }
        })
        $("#code").blur(function () {
            var code = $("#code").val();
            if(code == 0){
                $("#newscode").html('*验证码不能为空');
                return false;
            }
            if(code.length < 4){
                $("#newscode").html('*验证码不能小于4');
                return false;
            }else{
                $("#newscode").html('');
            }
        })
        //点击发送验证码触发事件
        $("#send_sms").click(function () {
            var phone = $("#phone").val();
            //定时器触发秒数
            var seconde = 11;
            var time =  setInterval(function(){
                seconde --;
                $("#send_sms").val(seconde+'秒后重新发送');
                $("#send_sms").attr("disabled","disabled");
                if (seconde < 1){
                    $("#send_sms").removeAttr("disabled","disabled");
                    $("#send_sms").val('获取验证码');
                    clearInterval(time);
                }
            }, 1000);

            $.ajax({
                //路由
                url:'/home/sendSms',
                type:'get',
                data:{'phone':phone},
                //成功返回数据
                success:function (data) {
                    if(data.status == 0) {
                        //正确的处理逻辑
                        $("#msg").html(data.message);
                    }
                    if(data.status == 1) {
                        // 错误的处理逻辑
                        $("#msg").html(data.message);
                    }
                    if(data.status == 2) {
                        // 错误的处理逻辑
                        $("#msg").html(data.message);
                    }
                },
                dataType:'json',//设置数据格式
            })
        })
        $("form").submit(function () {
            var phone = $("#phone").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var repass = $("#repass").val();
            var code = $("#code").val();

            $.ajax({
                url:'/home/regval',
                type:'post',
                data:{
                    'phone':phone,
                    'name':name,
                    'email':email,
                    'password':password,
                    'repass':repass,
                    'code':code,
                    '_token':"{{csrf_token()}}",
                },
                success:function (data,status,xhr) {
                    //成功返回数据
                    //console.log(data.status);//成功
                    if (data.status == 0) {
                        location.href = '{{url('home/login')}}';
                        //location.href = '/home/doRegister';
                    }
                    if (data.status == 1) {
                        location.href = '{{url('home/register')}}';
                    }
                },
                error:function (xhr,status,message) {
                    //失败返回数据
                    eval("var errors ="+ xhr.responseText);//变成对象
                    if (errors.name) {
                        $("#newsname").html(errors.name[0]);
                    }else{
                        $("#newsname").html('');
                    }
                    if (errors.phone) {
                        $("#newsphone").html(errors.phone[0]);
                    }else{
                        $("#newsphone").html('');
                    }
                    if (errors.email) {
                        $("#newsemail").html(errors.email[0]);
                    }else{
                        $("#newsemail").html('');
                    }
                    if (errors.password) {
                        $("#newspass").html(errors.password[0]);
                    }else{
                        $("#newspass").html('');
                    }
                    if (errors.repass) {
                        $("#newsrepass").html(errors.repass[0]);
                    }else{
                        $("#newsrepass").html('');
                    }
                    if (errors.code) {
                        $("#newscode").html(errors.code[0]);
                    }else{
                        $("#newscode").html('');
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