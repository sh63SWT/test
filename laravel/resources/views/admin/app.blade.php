<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/admin/ch-ui.admin.css">
    <link rel="stylesheet" href="/css/admin/font/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/public/jquery.js"></script>
    <script type="text/javascript" src="/js/admin/ch-ui.admin.js"></script>
    <link rel="stylesheet" href="/css/public/bootstrap.css">
    @yield('my-css')
</head>
<body>
<!--头部 开始-->
<div class="top_box">
    <div class="top_left">
        <div class="logo">后台管理</div>
        <ul>
            <li><a href="/admin/index" class="active">首页</a></li>
            {{--<li><a href="#">管理页</a></li>--}}
        </ul>
    </div>
    <div class="top_right">
        <ul>
            <li>管理员：{{Auth::guard('admin')->user()->name}}</li>
            {{-- <li>管理员：{{ Session::get('admin') }}</li>--}}
            {{--<li><a href="/admin/pass" target="main">修改密码</a></li>--}}
            <li><a href="/home/logout">退出</a></li>
        </ul>
    </div>
</div>
<!--头部 结束-->
<!--左侧导航 开始-->
<div class="menu_box">
    <ul>
        <li>
            <h3><i class="fa fa-fw fa-clipboard"></i>管理员管理</h3>
            <ul class="sub_menu">
                <li><a href="/admin-list"><i class="fa fa-fw fa-list-ul"></i>管理员列表</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="fa fa-fw fa-clipboard"></i>用户管理</h3>
            <ul class="sub_menu">
                <li><a href="/user-list"><i class="fa fa-fw fa-list-ul"></i>用户列表</a></li>
                <li><a href="/answer-list"><i class="fa fa-fw fa-list-ul"></i>密码提问</a></li>
            </ul>
        </li>
        {{--<li>--}}
            {{--<h3><i class="fa fa-fw fa-clipboard"></i>权限管理</h3>--}}
            {{--<ul class="sub_menu">--}}
                {{--<li><a href="/permission-list"><i class="fa fa-fw fa-list-ul"></i>权限列表管理</a></li>--}}
                {{--<li><a href="/permission-Add"><i class="fa fa-fw fa-list-alt"></i>添加权限管理</a></li>--}}
                {{--<li><a href="/permission-Update"><i class="fa fa-fw fa-plus-square"></i>修改权限管理</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<h3><i class="fa fa-fw fa-clipboard"></i>商品管理</h3>--}}
            {{--<ul class="sub_menu">--}}
                {{--<li><a href="/role-list"><i class="fa fa-fw fa-list-ul"></i>商品列表管理</a></li>--}}
                {{--<li><a href="/role-Add"><i class="fa fa-fw fa-list-alt"></i>添加商品管理</a></li>--}}
                {{--<li><a href="/role-Update"><i class="fa fa-fw fa-plus-square"></i>修改商品管理</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
    </ul>
</div>
<!--左侧导航 结束-->
<!--主体部分 开始-->
<div class="main_box">
   @yield('content')
</div>
<!--主体部分 结束-->

<!--底部 开始-->
<div class="bottom_box">
    CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
</div>
<!--底部 结束-->
@yield('my-js')
</body>
</html>