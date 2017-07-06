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
	<link href="{{ URL::asset('css/home/follow-list.b9e959cd.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('js/home/hm.js') }}" rel="stylesheet">
	<link rel="stylesheet" href="/css/public/bootstrap.css">

	<!-- /people/followed/list/ -->
	<script src="{{ URL::asset('js/home/hm.js') }}"></script><script type="text/javascript">
        var USER = {},
            BIND_SITES = {};
        USER.ID = 15081883;
        USER.username = "吝啬诗人";
        USER.smallAvatar = "https://b-ssl.duitang.com/uploads/people/201706/19/20170619222054_dzBPy.thumb.48_48_c.jpeg";
        USER.isCertifyUser = false;
	</script>
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
	<div class="layer layer-1to5">
		<div class="tube tube-b">
			<div class="block">
				<!-- 面包屑 -->
				<div class="box nav-box">
					<!--面包屑 s-->
					<h2 class="line">
						<a href="">我的堆糖</a> &gt; 我的关注
					</h2>
				</div>
				<div class="box-d box rs-plist">
					<div class="tt"><span class="l b">我的关注</span></div>
					<!-- 关注列表人物 -->
					@if($cares)
						<div class="cont">
							<ul id="pp-dblist" class="ctr-dblist ctr-dblistpro pp-dblist">
								<!-- 循环关注 -->
								@foreach($cares as $value)
									<li>
										<div class="pimg">
											<a href="">
												@if($value->icon)
													<td>
														<img src="{{URL::asset('img/')}}/{{$value->icon}}" id="{{$value->id}}" height="50px"  width="50px" alt="">
													</td>
												@else
													<td>
														<img src="{{URL::asset('img/admin/default.png')}}" id="{{$value->id}}"  height="50px" width="50px" alt="">
													</td>
												@endif
											</a>
										</div>
										<div class="th">
											<b><a href="" id="{{$value->id}}" class="ppdaren">{{$value->name}}</a></b>
											<div class="r psoper">
												<!-- 未关注 -->
												@if($value->sta == 0)
												<!-- 关注 -->
													<a class="l lkl graylk">关注</a>
													<a href="/home/delcare/{{$value->id}}" class="l lkl graylk">取消</a>
													{{--<a href="/home/addcare/{{$value->id}}" class="unfollow" href="javascript:;" data-follow="{&quot;rel&quot;:1,&quot;id&quot;:&quot;802129&quot;}" title="已关注" onmousedown="$.G.gaq(['_trackPageview', '/_trc/Follow/_/del']);"><i></i>已关注</a>--}}
													{{--<a href="/home/addver/{{$value->id}}" class="follow followed" href="javascript:;" data-follow="{&quot;rel&quot;:2,&quot;id&quot;:&quot;15051101&quot;,&quot;name&quot;:&quot;__许诺&quot;}" title="加关注" onmousedown="$.G.gaq(['_trackPageview', '/_trc/Follow/_/add_add']);"><i></i>关注</a>--}}
													{{--<a class="l lkl graylk" data-sendto="{&quot;id&quot;:&quot;15051101&quot;,&quot;name&quot;:&quot;__许诺&quot;}" href="javascript:;">发私信</a>--}}
												@else
												<!-- 互相关注 -->
													<a class="l lkl graylk">互关</a>
													<a href="/home/delcare/{{$value->id}}" class="l lkl graylk">取消</a>
													<a href="/care/catList/{{$value->id}}" class="l lkl graylk" data-sendto="{&quot;id&quot;:&quot;15051101&quot;,&quot;name&quot;:&quot;__许诺&quot;}" href="javascript:;">发私信</a>
													{{--<a href="/home/delcare/{{$value->id}}" class="unfollow followeo" href="javascript:;" data-follow="{&quot;rel&quot;:3,&quot;id&quot;:&quot;15051101&quot;,&quot;name&quot;:&quot;__许诺&quot;}" title="已关注" onmousedown="$.G.gaq(['_trackPageview', '/_trc/Follow/_/add_del']);"><i></i>已关注</a>--}}
												@endif
											</div>
										</div>
										<div class="pcount clr"></div>
									</li>
								@endforeach
							</ul>
						</div>
					@else
						<div class="tc zero">
							<div class="ico-null dib mr8"></div>
							<div class="zero-cont dib">暂时没有关注。</div>
						</div>
					@endif
				<!-- 页码 -->
					<div class="pager">
						<ul>
							@if($result)
								<li>{{$result->links()}}</li>
							@else
								<li></li>
							@endif
						</ul>
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
</body>
</html>