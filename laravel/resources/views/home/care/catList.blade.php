<!DOCTYPE html>
<!-- saved from url=(0062)https://www.duitang.com/people/followed/list/?user_id=15081883 -->
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta property="wb:webmaster" content="973d669418f79e8b">
	<title>我的关注</title>
	<meta name="keywords" content="堆糖,插画,手工,背景墙,短发发型,时尚生活,lookbook,时尚购">
	<meta name="description" content="分享收集有关时尚生活的各种图片资讯，手工DIY、插画手绘、美食菜谱、潮流品牌、搭配街拍、美妆发型等等。">
	<link href="http://www.duitang.com/favicon.ico" rel="SHORTCUT ICON">
	<link href="{{ URL::asset('css/home/lib.f0824a12.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/home/letter.detail.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/home/follow-list.b9e959cd.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('js/home/hm.js') }}" rel="stylesheet">
	<link rel="stylesheet" href="/css/public/bootstrap.css">

	<!-- /people/followed/list/ -->
	<script src="{{ URL::asset('js/home/hm.js') }}"></script><script type="text/javascript">
        var USER = {},
            BIND_SITES = {};
        USER.ID = 15081883;
        USER.username = "吝啬诗人";
        USER.smallAvatar = "";
        USER.isCertifyUser = false;
	</script><script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "";
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
											<img class="dt-avatar" src="">
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
				</div>
			</div>
		</div>
	</div>
</div>
<div id="content">
	<div class="layer layer-full">
		<div class="tube">
			<div class="pg-main-l">
				<div class="pg-main-ll">
					<div class="pg-main-ll-inner">
						@if($name->icon)
							<a><img src="{{URL::asset('img/')}}/{{$name->icon}}" height="60px"  width="60px" alt=""></a>
						@else
							<a><img src="{{URL::asset('img/admin/default.png')}}" height="60px" width="60px" alt=""></a>
						@endif
						@if($name->name)
							<a>{{$name->name}}</a>
						@else
							<a>暂无</a>
						@endif
						@if($name->sex)
							@if($name->sex == 1)
								<a>（男）</a>
							@else
								<a>(女)</a>
							@endif
						@else
							<a>暂无</a>
						@endif
					</div>
				</div>
					<div class="pg-main-lr clr">
						<div id="pg-lr-content" class="pg-lr-content pg-lr-content3">
							<div class="letterApp" data-reactid=".0">
								<div class="pg-main-l-talk" data-reactid=".0.0">
									<div class="pg-main-l-title" data-reactid=".0.0.0">
										<p class="l" data-reactid=".0.0.0.0">
											<span data-reactid=".0.0.0.0.0">与 </span>
											<span class="pg-pticiptname" data-reactid=".0.0.0.0.1">{{$name->name}}</span>
											<span data-reactid=".0.0.0.0.2"> 的私信</span>
											<a href="/home/delcat/{{$name->id}}"><span data-reactid=".0.0.0.0.2"> (清空私信)</span></a>
										</p>
										<a href="/notification/#/letters/1" onclick="history.go(-1)" class="pg-back r" data-reactid=".0.0.0.1">返回上一层</a>
									</div>
									<div class="pg-main-letter" data-reactid=".0.0.1">
										{{--<div class="pg-people-avatar" data-reactid=".0.0.1.0">--}}
										{{--<img alt="" class="pg-people-image" data-reactid=".0.0.1.0.0" src="https://b-ssl.duitang.com/uploads/item/201607/25/20160725103153_AWRUu.thumb.48_48_c.jpeg">--}}
										{{--</div>--}}
										<div class="pg-t-msg-text clr" data-reactid=".0.0.1.1">
											<form id="send-mail" method="post" action="/home/sendcat" data-reactid=".0.0.1.1.0">
												{{csrf_field()}}
												<input type="hidden" id="uid" name="uid" value="{{Auth::guard()->user()->id}}">
												<input type="hidden" id="sid" name="sid" value="{{$name->id}}">
												<input type="hidden" name="action" value="sendmsg" data-reactid=".0.0.1.1.0.0">
												<input type="hidden" name="name" data-reactid=".0.0.1.1.0.1" value="duitang">
												<label class="dn" data-reactid=".0.0.1.1.0.2">发送</label>
												{{--<textarea id="txa-message" name="msg" class="msg-txa" data-reactid=".0.0.1.1.0.3" style="overflow: hidden; height: 100px;"></textarea>--}}
												<input id="cat" type="text" style="width:640px;height:50px;" value="">
												<div class="msg-subtn" data-reactid=".0.0.1.1.0.4">
													<a class="abtn msg-up" target="_self" href="" data-reactid=".0.0.1.1.0.4.0">
														<button type="submit" data-reactid=".0.0.1.1.0.4.0.0">
															<u data-reactid=".0.0.1.1.0.4.0.0.0">发送</u>
														</button>
													</a>
												</div>
												<input type="hidden" id="pg-Mess-toid" name="user_id" data-reactid=".0.0.1.1.0.5" value="1">
											</form>
										</div>
									</div>
								</div>
								@if($ress)
									@foreach($ress as $v)
									<div class="letterDetail" data-reactid=".0.1">
										<div class="pg-main-letter" data-reactid=".0.1.$0">
											<div class="pg-people-avatar" data-reactid=".0.1.$0.0">
												<a href="/people/?user_id=1" target="_blank" data-reactid=".0.1.$0.0.0">
													@if($v->icon)
														<img src="{{URL::asset('img/')}}/{{$v->icon}}" class="pg-people-image" data-reactid=".0.1.$0.0.0.0"></a>
													@else
														<img src="{{URL::asset('img/admin/default.png')}}" class="pg-people-image" data-reactid=".0.1.$0.0.0.0"></a>
													@endif
											</div>
											<div class="pg-detail-people-info clr" data-reactid=".0.1.$0.1">
												<p class="pg-people-name" data-reactid=".0.1.$0.1.0">
													<a href="/people/?user_id=1" target="_blank" data-reactid=".0.1.$0.1.0.0">{{$v->name}}</a>
													<span class="pg-uptime" data-reactid=".0.1.$0.1.0.1">
														<span data-reactid=".0.1.$0.1.0.1.0"> · </span>
														<span data-reactid=".0.1.$0.1.0.1.1">{{$v->time}}</span>
												</span>
												</p>
												<p class="pg-people-msg" data-reactid=".0.1.$0.1.1">{{$v->cat}}</p>
											</div>
										</div>
									</div>
									@endforeach
								@else
								@endif
								<div class="">
									<ul>
										<li>{{$result->links()}}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- 尾部 -->
<div id="footer" class="footer">
	<div class="footcont">
		<div class="footwrap">
			<div class="dt-footer-frdlk">
				<a href="https://www.duitang.com/keywords/">标签集</a>
				<a id="sitehelp" href="https://www.duitang.com/help/index/">帮助中心</a>
				<a href="https://www.duitang.com/about/">关于我们</a>
				<a href="https://www.duitang.com/jobs/">加入我们</a>
				<a href="https://www.duitang.com/declare/#noduty">免责声明</a>
				<a href="https://www.duitang.com/about/collectit/">堆糖收集工具</a>
				<a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010102002072" class="beian1" target="_blank"></a>
			</div>
			<span class="dt-footer-icp">©2017 duitang.com 版权所有。<a href="http://www.miitbeian.gov.cn/" target="_blank">沪ICP备10038086号-3</a></span>
		</div>
	</div>
</div>
<div id="win-house" class="h0">
	<div id="Mess-send" class="win-wraper Mess-send">
		<form id="form-message" method="post">
			<input type="hidden" name="action" value="sendmsg">
			<textarea id="txa-message" name="msg" class="txa"></textarea>
			<div class="clr mt8">
				<a class="abtn l" target="_self" href="javascript:;">
					<button type="submit"><u>发送</u></button>
				</a>
			</div>
			<input type="hidden" id="Mess-toid" name="user_id" value="">
		</form>
	</div>
</div>
<div id="foot-forms" class="dn">
</div>
<script>
	$(function () {
	    $('#send-mail').submit(function() {
            var uid = $("#uid").val();
            var sid = $("#sid").val();
            var cat = $("#cat").val();
			$.ajax({
                url:'/home/sendcat',
                type:'post',
                data:{
                    'uid':uid,
					'sid':sid,
                    'cat':cat,
                    '_token':"{{csrf_token()}}",
                },
                success:function (data,status,xhr) {
                    //成功返回数据
                    //console.log(data.status);//成功
                    if (data.status == 0) {
                        location.href = location.href;
//						alert('回复成功');
                        //location.href = '/home/doRegister';
                    }
                    if (data.status == 1) {
                        location.href = '{{url('home/register')}}';
                    }
                },
                dataType:'json',//设置数据格式
            });
			return false;
		})
	})
</script>
</body>
</html>
