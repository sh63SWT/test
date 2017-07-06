@extends('admin.app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="">首页</a> &raquo; <a href="#">问题管理</a> &raquo; 问题列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    @if($result_sta == 2)
                    @else
                        <a href="/answer-toAdd"><i class="fa fa-plus"></i>添加问题</a>
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
                        <th>问题</th>
                        <th>操作</th>
                    </tr>
                    @if($result)
                        @foreach($result as $v)
                        <tr>
                            <td class="tc">{{$v->id}}</td>
                            <td class="tc">{{$v->answer}}</td>
                            @if($result_sta == 2)
                                <td>权限不够</td>
                            @else
                                <td>
                                    <a href="/answer-upd/{{$v->id}}">修改问题</a>
                                    <a href="/answer-del/{{$v->id}}">删除问题</a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="3">当前没有设置问题</td></tr>
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