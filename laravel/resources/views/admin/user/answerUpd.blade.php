@extends('admin.app')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">问题管理</a> &raquo; <a href="#">问题列表</a> &raquo;添加问题
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
        <form action="/answer-upd" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                @foreach($answerUpd as $v)
                    <input type="hidden" name="id" value="{{$v->id}}">
                    <tr>
                    <th width="120"><i class="require">*</i>更改问题：</th>
                    <td>
                        <input id="answer" type="text" class="mg" name="answer" value="{{$v->answer}}">
                        <span id="sanswer" style="color:red;"></span>
                    </td>
                </tr>
                @endforeach
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
            $("#answer").blur(function () {
                var answer = $("#answer").val();
                if(answer == 0){
                    $("#sanswer").html('*问题不能为空');
                    return false;
                }else{
                    $("#sanswer").html('');
                }
                return false;
            })
        })
    </script>
@endsection