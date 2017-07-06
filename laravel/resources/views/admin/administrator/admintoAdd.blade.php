@extends('admin.app')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">管理员管理</a> &raquo; <a href="#">管理员列表</a> &raquo;添加管理员
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <p><i class="fa fa-plus"></i>操作</p>
                {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="/admin-add" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>权限：</th>
                    <td>
                        @if($result_sta == 0)
                            <select name="status">
                                {{--<option value="">==请选择==</option>--}}
                                {{--<option value="0">超级管理员</option>--}}
                                <option value="1">高级管理员</option>
                                <option value="2">普通管理员</option>
                            </select>
                        @elseif($result_sta == 1)
                            <select name="status">
                                {{--<option value="">==请选择==</option>--}}
                                {{--<option value="1">高级管理员</option>--}}
                                <option value="2">普通管理员</option>
                            </select>
                        @else
                            <select name="status" disabled="disabled">
                                {{--<option value="">==请选择==</option>--}}
                                <option value="2">普通管理员</option>
                            </select>
                        @endif
                        {{--@if (count($errors) > 0)--}}
                            {{--<p>{{$errors->first('status')}}</p>--}}
                        {{--@endif--}}
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>管理员名：</th>
                    <td>
                    @if($result_sta == 2)
                        <input id="name" type="text" class="mg" name="name" disabled="disabled">
                    @else
                        <input id="name" type="text" class="mg" name="name">
                    @endif
                    <span id="sname" style="color:red;"></span>
                    {{--@if (count($errors) > 0)--}}
                            {{--<p>{{$errors->first('name')}}</p>--}}
                    {{--@endif--}}
                    </td>
                </tr>
                <tr>
                    <th><i class="require" >*</i>管理员邮箱：</th>
                    <td>
                        @if($result_sta == 2)
                            <input id="email" type="text" class="mg" name="email" disabled="disabled">
                        @else
                            <input id="email" type="text" class="mg" name="email">
                        @endif
                        <span id="semail" style="color:red;"></span>
                        {{--@if (count($errors) > 0)--}}
                                {{--<p>{{$errors->first('email')}}</p>--}}
                        {{--@endif--}}
                    </td>
                </tr>
                <tr>
                    <th>密码：</th>
                    <td>
                        @if($result_sta == 2)
                            <input id="password" type="password" class="mg" name="password" disabled="disabled">
                        @else
                            <input id="password" type="password" class="mg" name="password">
                        @endif
                        <span id="spassword" style="color:red;"></span>
                        {{--@if (count($errors) > 0)--}}
                            {{--<p>{{$errors->first('password')}}</p>--}}
                        {{--@endif--}}
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        @if($result_sta == 2)
                            <input type="submit" value="没有权限" disabled="disabled">
                        @else
                            <input type="submit" value="提交">
                        @endif
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
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
                    $("#spassword").html('*密码不能为空');
                    return false;
                }
                if(password.length < 6){
                    $("#spassword").html('*密码不能小于6');
                    return false;
                }else{
                    $("#spassword").html('');
                }
            })
        })
    </script>
@endsection