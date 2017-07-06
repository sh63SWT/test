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
        <form action="/user-add" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th width="120"><i class="require">*</i>头像：</th>
                    <td>
                        <input id="icon" type="file" class="mg" name="icon">
                        <span id="sicon" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120"><i class="require">*</i>用户名：</th>
                    <td>
                        <input id="name" type="text" class="mg" name="name">
                        <span id="sname" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120"><i class="require">*</i>密码：</th>
                    <td>
                        <input id="password" type="password" class="mg" name="password">
                        <span id="spass" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120"><i class="require">*</i>生日：</th>
                    <td>
                        <input id="birthday" type="date" class="mg" name="birthday">
                        <span id="sbirthday" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120"><i class="require">*</i>手机号码：</th>
                    <td>
                        <input id="phone" type="text" maxlength="11" class="mg" name="phone">
                        <span id="sphone" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120"><i class="require">*</i>用户性别：</th>
                    <td>
                        <input id="sex" type="radio" name="sex" value="1" checked>男
                        <input id="sex" type="radio" name="sex" value="2" >女
                        <span id="ssex" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120"><i class="require">*</i>邮箱：</th>
                    <td>
                        <input id="email" type="email" class="mg" name="email">
                        <span id="semail" style="color:red;"></span>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
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
@endsection