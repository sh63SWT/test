@extends('admin.app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="">首页</a> &raquo; <a href="#">用户管理</a> &raquo; 用户列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    {{--<a href="/user-toAdd"><i class="fa fa-plus"></i>添加用户</a>--}}
                    {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
                    {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th>ID</th>
                        <th>用户头像</th>
                        <th>用户名称</th>
                        <th>用户关系</th>
                        <th>操作</th>
                    </tr>
                    @if($cares)
                        @foreach($cares as $user)
                        <tr>
                            <td class="tc">{{$user->id}}</td>
                            @if($user->icon)
                                <td><img src="{{URL::asset('img/')}}/{{$user->icon}}" height="60px"  width="60px" alt=""></td>
                            @else
                                <td><img src="{{URL::asset('img/admin/default.png')}}" height="60px" width="60px" alt=""></td>
                            @endif
                            <td>{{$user->name}}</td>
                            <td>粉丝</td>
                            {{--判断获取到的当前用户状态--}}
                            {{--超级高级--}}
                            <td>
                                @if($sta==2)
                                    <p>权限不足</p>
                                @else
                                    <a href="/user-delver/{{$user->id}}">取消粉丝</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5">当前用户没有粉丝的人</td></tr>
                    @endif
                </table>
                <div class="">
                    <ul>
                        <li>{{$result->links()}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection