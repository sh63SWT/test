<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/public/bootstrap.css')}}">
    <script type="text/javascript" src="/js/public/jquery-1.8.3.min.js"></script>
    <title>后台用户登录</title>
    <style>
        .form-signin{
            width:300px;
            margin:0 auto;
            margin-top:120px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="form-signin" action="{{url('admin/doLogin')}}" method="post">
            {{csrf_field()}}
            <h2 class="form-signin-heading">欢迎登陆</h2>
            <p>
                <input type="text"  id="email" name="email" class="form-control" placeholder="请输入邮箱地址" required="" autofocus="">
                <p><span id="semail"></span></p>
                {{--@if (count($errors) > 0)--}}
                {{--<p>{{$errors->first('email')}}</p>--}}
                {{--@endif--}}
            </p>
           <p>
               <input type="password" id="password" name="password" class="form-control" placeholder="请输入密码" required="">
                {{--@if (count($errors) > 0)--}}
                    {{--<p>{{$errors->first('password')}}</p>--}}
                {{--@endif--}}
                <p><span id="spass"></span></p>
           </p>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1"> 记住密码
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
        </form>
    </div>
    <script>
        $(function () {
            $("#email").blur(function () {
                var email = $("#email").val();
                $.ajax({
                    url:'/admin/emails',
                    type:'get',
                    data:{'email':email},
                    success:function (data) {
                        if(data.status == 0)
                        {
                            $("#semail").html(data.mess);
                        }
                        if(data.status == 1)
                        {
                            $("#semail").html(data.mess);
                        }
                    },
                    error:function (xhr,status,message) {
                        eval("var errors ="+ xhr.responseText);
                        if (errors.email) {
                            $("#semail").html(errors.email[0]);
                        }else{
                            $("#semail").html('');
                        }
                    },
                    dataType:'json',
                });
                return false;
            })
            $("#password").blur(function () {
                var password = $("#password").val();
                if(password == 0){
                    $("#spass").html('*密码不能为空');
                    return false;
                }
                if(password.length < 6) {
                    $("#spass").html('*密码不能小于6位');
                }
                else {
                    $("#spass").html('');
                }
            })
        })
    </script>
</body>
</html>