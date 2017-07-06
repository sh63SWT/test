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
                    @if($result_sta == 0 || $result_sta == 1)
                    <a href="/user-toAdd"><i class="fa fa-plus"></i>添加用户</a>
                    @endif
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
                        <th>用户邮箱</th>
                        <th>用户电话</th>
                        <th>用户性别</th>
                        <th>用户生日</th>
                        <th>用户关系</th>
                        <th>注册时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td class="tc">{{$user->id}}</td>
                        @if($user->icon)
                            <td><img src="{{URL::asset('img/')}}/{{$user->icon}}" height="60px"  width="60px" alt=""></td>
                        @else
                            <td><img src="{{URL::asset('img/admin/default.png')}}" height="60px" width="60px" alt=""></td>
                        @endif
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        @if($user->sex == 1)
                            <td>男</td>
                        @endif
                        @if($user->sex == 2)
                            <td>女</td>
                        @endif
                        <td>{{$user->birthday}}</td>
                        <td>
                            <a href="/user-care/{{$user->id}}/{{$result_sta}}">关注</a>
                            <a href="/user-ver/{{$user->id}}/{{$result_sta}}">粉丝</a>
                        </td>
                        <td>{{$user->regtime}}</td>
                        @if($user->status == 1)
                            <td>使用中</td>
                        @else
                            <td>禁用中</td>
                        @endif
                        {{--判断获取到的当前用户状态--}}
                        {{--超级高级--}}
                        @if($result_sta == 0 || $result_sta == 1)
                            <td>
                                <a href="/user-update/{{$user->id}}">修改</a>
                                @if($user->status == 1)
                                    <a href="/user-status/{{$user->id}}/{{$user->status}}">禁用</a>
                                @else
                                    <a href="/user-status/{{$user->id}}/{{$user->status}}">启用</a>
                                @endif
                                    <a href="/user-delete/{{$user->id}}">删除</a>
                            </td>
                        {{--普通--}}
                        @else
                            <td>权限不足</td>
                        @endif
                    </tr>
                    @endforeach
                </table>
                <div class="">
                    <ul>
                        <li>{{$users->links()}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection