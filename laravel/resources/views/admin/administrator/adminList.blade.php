@extends('admin.app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="">首页</a> &raquo; <a href="#">管理员管理</a> &raquo; 管理员列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="/admin-toAdd"><i class="fa fa-plus"></i>添加管理员</a>
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
                        <th>管理员名称</th>
                        <th>管理员邮箱</th>
                        <th>权限名称</th>
                        <th>操作</th>
                    </tr>
                    @foreach($admins as $admin)
                    <tr>
                        <td class="tc">{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        {{--判断获取到的当前用户状态--}}
                        {{--超级--}}
                        @if($result_sta == 0)
                            {{--判断当前用户权限名称--}}
                            @if($admin->status == 0)
                                <td>超级权限</td>
                            @endif
                            @if($admin->status == 1)
                                <td>高级权限</td>
                            @endif
                            @if($admin->status == 2)
                                <td>普通权限</td>
                            @endif
                            {{--操作都有--}}
                            <td>
                                <a href="/admin-Update/{{$admin->id}}">修改</a>
                                <a href="/admin-delete/{{$admin->id}}">删除</a>
                            </td>
                        {{--高级    --}}
                        @elseif($result_sta == 1)
                            {{--判断当前用户权限名称--}}
                            @if($admin->status == 0)
                                <td>超级权限</td>
                            @endif
                            @if($admin->status == 1)
                                <td>高级权限</td>
                            @endif
                            @if($admin->status == 2)
                                <td>普通权限</td>
                            @endif
                            {{--如果当前状态是1的并且当前用户id为获取id,或者获取到的用户状态为普通时添加--}}
                            @if ( $result_sta == 1 && $result_id == $admin->id  || $admin->status == 2)
                                <td>
                                    <a href="/admin-Update/{{$admin->id}}">修改</a>
                                    <a href="/admin-delete/{{$admin->id}}">删除</a>
                                </td>
                            @else
                                <td>权限不足</td>
                            @endif
                            {{--普通--}}
                        @else
                            @if($admin->status == 0)
                                <td>超级权限</td>
                            @endif
                            @if($admin->status == 1)
                                <td>高级权限</td>
                            @endif
                            @if($admin->status == 2)
                                <td>普通权限</td>
                            @endif
                            @if ( $result_sta == 2 && $result_id == $admin->id )
                                <td>
                                    <a href="/admin-Update/{{$admin->id}}">修改</a>
                                    <a href="/admin-delete/{{$admin->id}}">删除</a>
                                </td>
                            @else
                                <td>权限不足</td>
                            @endif
                        @endif
                    </tr>
                    @endforeach
                </table>
                <div class="">
                    <ul>
                        <li>{{$admins->links()}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection