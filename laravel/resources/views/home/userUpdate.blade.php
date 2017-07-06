<!DOCTYPE html>
	<head>
		<title>堆糖，美好生活研究所</title>
	<link href="{{ URL::asset('css/home/lib.f0824a12.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/home/index.8ae7461d.css') }}" rel="stylesheet">
	<script type="text/javascript" src="/js/public/jquery.js"></script>
	{{--	<script type="text/javascript" src="{{ URL::asset('js/home/hm.js') }}"></script>--}}
	<script type="text/javascript">
	</script>
	{{--<script src="/public/js/home/lib.bundle.c831fe83.js"></script>--}}
	<script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?d8276dcc8bdfef6bb9d5bc9e3bcfcaf4";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
	</script>
	<script src="{{ URL::asset('js/home/lib.bundle.c831fe83.js') }}"></script>
	</head>
<body>
<!-- 头部 -->
	<div id="header">
	<div style="width: 100%; height: 65px;">
	<div class="pnav-header SG-posfollow" style="position: fixed; bottom: auto; z-index: 998; width: 100%; height: 65px; left: 0px; right: auto; top: 0px;">
	<div class="SG-sidecont">
	<div id="header-wrap">
		<div id="dt-header">
			<div class="dt-wrap">
				<!-- logo更改 -->
				<a id="dt-logo" href="https://www.duitang.com/">堆糖</a>
				<div id="dt-header-right">
					@if(Auth::guard()->user()->name)
						<div id="dt-account" class="dt-has-menu dt-head-cat">
							<a class="dt-account-btn" href="">
								<img class="dt-avatar" src="{{Session::get('icon') }}">
								<span>我的堆糖</span> <i></i>
							</a>
							<div class="dt-menu">
								<div class="dt-menu-inner dt-menu-mini">
									<a id="mynavtools-home" href="">
										<i></i>
										个人主页
									</a>
									<a id="mynavtools-setting" href="/home/vipUpdate">
										<i></i>
										账号设置
									</a>
									<div class="dt-menu-bottom">
										<a id="mynavtools-logout" href="/home/logout">
											<i></i>
											退出
										</a>
									</div>
								</div>
							</div>
						</div>
					@else
						<div class="dt-vline"></div>
						<a href="/home/login" id="dt-login" class="dt-btn dt-head-cat" href="javascript:;" data-next="/">登录</a>
						<div class="dt-vline"></div>
						<a href="/home/register" id="dt-register" class="dt-btn dt-head-cat" href="">注册</a>
						<div class="dt-vline"></div>
					@endif
					<div class="dt-has-menu dt-head-cat">
					</div>
					<div id="dt-add" class="dt-has-menu dt-head-cat">
						<div class="dt-menu">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="dt-header-btm"></div>
	</div></div></div></div></div>
	<div id="content">
		<div class="block">
			<div class="box">
				<h2>
					<a href="">我的堆糖</a>&nbsp;&gt;&nbsp;
					<a href="javascript:;">账号设置</a>&nbsp;&gt;&nbsp;
					<a href="javascript:;" class="changename">基本信息</a>
				</h2>
			</div>
			<div class="pb8 set-mt15">
				<ul class="ctr-sw">
				</ul>
			</div>
	</div>
	<div class="info-main-area">
		<div class="hset set-info" style="display: block;">
			<div class="block">
				<div class="ps-info-img">
					<div class="ps-img-d">
						<a id="myphotoa" href="javascript:;">
							@if($users->icon)
								<td>
									<img src="{{URL::asset('img/')}}/{{$users->icon}}" height="120px"  width="120px" alt="">
								</td>
							@else
								<td>
									<img src="{{URL::asset('img/admin/default.png')}}" height="120px" width="120px" alt="">
								</td>
							@endif
						</a>
					</div>
				</div>
					<div id="set-uploadhead-holder" class="set-selectpic gray">
						<div id="default-dec" class="l20">
							在堆糖大家都是“有头有脸”的朋友，上传头像让大家更快认识您。 <br> 选择喜欢的图片作为您的头像：
						</div>
					<div class="clr mt8">
						<div class="l mt8 gray">
						{{--可以上传jpg,gif,png格式的图片，且文件小于2M--}}
						</div>
					</div>
				</div>
			</div>
			<div class="block brdsep">
				<form id="form-upemail" action="/home/vipUpdate" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" name="uid" value="{{$users->id}}">
					<div class="set-baseinfo">
						<table class="tableform" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td>更改头像</td>
									<td>
										<input type="file" value="更改头像" name="icon">
										<div class="error"></div>
									</td>
									<td>(更改用户头像)</td>
								</tr>
								<tr>
									<td>用户名称</td>
									<td>
										<input id = "name" class="ipt" type="text" name="name" value="{{$users->name}}">

										<div class="error"><span id="sname"></span></div>
									</td>
									<td>(更改用户名称)</td>
								</tr>
								<tr>
									<td>手机号码</td>
									<td>
										<input id = "phone" class="ipt" type="text" name="phone" readonly="readonly" value="{{$users->phone}}">
										{{--<div class="error"><span id="sphone"></span></div>--}}
									</td>
									<td>(不可更改)</td>
								</tr>
								<tr>
									<td>邮箱地址</td>
									<td>
										<input id="email" type="email" class="ipt" name="email" value="{{$users->email}}">
										<div class="error"><span id="semail"></span></div>
									</td>
									<td>(更改邮箱地址)</td>
								</tr>
								<tr>
									<td>修改性别</td>
									<td>
										@if($users->sex == 1)
											<input type="radio"  name="sex" value="1" checked>男
											<input type="radio"  name="sex" value="2" >女
										@else
											<input type="radio"  name="sex" value="1" >男
											<input type="radio"  name="sex" value="2" checked>女
										@endif
										<div class="error"><span id="ssex"></span></div>
									</td>
									<td>(更改用户性别)</td>
								</tr>
								<tr>
									<td>更改生日</td>
									<td>
										<input id="birthday" type="date" class="ipt" name="birthday" value="{{$users->birthday}}">
										<div class="error"><span id="sbirthday"></span></div>
									</td>
									<td>(更改生日)</td>
								</tr>
								<tr>
									<td>更改密码</td>
									<td>
										<input id="password" class="ipt" type="password" class="mg" name="password" value="{{$users->password}}">
										<div class="error"><span id="spass"></span></div>
									</td>
									<td>(更改用户密码)</td>
									<td><a href="/home/getpass/{{$users->id}}">(设置找回密码)</a></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										<div class="clr mt8">
											<input type="submit" value="提交">
											<input type="button" class="back" onclick="history.go(-1)" value="返回">
											{{--<a id="emailUp" class="abtn abtn-w4" target="_self" href="javascript:;">--}}
												{{--<u>保存设置</u>--}}
											{{--</a>--}}
										</div>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
		</div>
	</div>
	<div id="footer" class="footer">
		<div class="footcont">
			<div class="footwrap">
				<div class="dt-footer-frdlk">
					<a href="">标签集</a>
					<a id="sitehelp" href="">帮助中心</a>
					<a href="">关于我们</a>
					<a href="">加入我们</a>
					<a href="">免责声明</a>
					<a href="">堆糖收集工具</a>
					<a href="" class="beian1" target="_blank"></a>
				</div>
				<span class="dt-footer-icp">©2017 duitang.com 版权所有。
					<a href="" target="_blank">沪ICP备10038086号-3</a>
				</span>
			</div>
		</div>
	</div>
<script>
    $(function () {
        $("#birthday").blur(function () {
            var birthday = $("#birthday").val();
            if(birthday == 0){
                $("#sbirthday").html('*生日不能为空');
                return false;
            }else{
                $("#sbirthday").html('');
            }
            return false;
        })
        $("#email").blur(function () {
            var email = $("#email").val();
            if(email == 0){
                $("#semail").html('*邮箱不能为空');
                return false;
            }else{
                $("#semail").html('');
            }
            $.ajax({
                url:'/user/emails',
                type:'get',
                data:{'email':email},
                success:function (data) {
                    if(data.status == 0)
                    {
                        $("#semail").html('*邮箱可以使用');
                    }
                    if(data.status == 1)
                    {
                        $("#semail").html('*邮箱已被使用');
                        return false;
                    }
                },
                error:function (xhr,status,message) {
                    eval("var errors ="+ xhr.responseText);
                    if (errors.email) {
                        $("#semail").html(errors.email[0]);
                        return false;
                    }else{
                        $("#semail").html('');
                    }
                },
                dataType:'json',
            });
            return false;
        })
        $("#phone").blur(function () {
            var phone = $("#phone").val();
            if(phone == 0){
                $("#sphone").html('*手机号不能为空');
                return false;
            }
            $.ajax({
                url:'/user/phones',
                type:'get',
                data:{'phone':phone},
                success:function (data) {
                    if(data.status == 0)
                    {
                        $("#sphone").html('*手机号可以使用');
                    }
                    if(data.status == 1)
                    {
                        $("#sphone").html('*手机号已被使用');
                        return false;
                    }
                },
                error:function (xhr,status,message) {
                    eval("var errors ="+ xhr.responseText);
                    if (errors.phone) {
                        $("#sphone").html(errors.phone[0]);
                        return false;
                    }else{
                        $("#sphone").html('');
                    }
                },
                dataType:'json',
            });
            return false;
        })
        $("#name").blur(function () {
            var name = $("#name").val();
            if(name.length == 0){
                $("#sname").html('*用户名不能为空');
                return false;
            }
            if(name.length < 2){
                $("#sname").html('*用户名不能小于2');
                return false;
            }else{
                $("#sname").html('');
            }
        })
        $("#password").blur(function () {
            var password = $("#password").val();
            if(password == 0){
                $("#spass").html('*密码不能为空');
                return false;
            }
            if(password.length < 6){
                $("#spass").html('*密码不能小于6');
                return false;
            }else{
                $("#spass").html('');
            }
        })
    })
</script>
</body>
</html>