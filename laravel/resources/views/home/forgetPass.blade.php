<!DOCTYPE html>
	<head>
		<title>堆糖，美好生活研究所</title>
	<link href="{{ URL::asset('css/home/lib.f0824a12.css') }}" rel="stylesheet">
{{--	<link href="{{ URL::asset('css/home/index.8ae7461d.css') }}" rel="stylesheet">--}}
	<script type="text/javascript" src="/js/public/jquery.js"></script>
	{{--	<script type="text/javascript" src="{{ URL::asset('js/home/hm.js') }}"></script>--}}
	<script type="text/javascript">
	</script>
	{{--<script src="/public/js/home/lib.bundle.c831fe83.js"></script>--}}
	</head>
<body>
<!-- 头部 -->
	<div id="content">
		<div class="info-main-area">
		<div class="hset set-info" style="display: block;">
			<div class="block">
				<div class="ps-info-img">
					<div class="ps-img-d">
						<a id="myphotoa" href="javascript:;">
						</a>
					</div>
				</div>
					<div id="set-uploadhead-holder" class="set-selectpic gray">
					<div class="clr mt8">
						<div class="l mt8 gray">
						{{--可以上传jpg,gif,png格式的图片，且文件小于2M--}}
						</div>
					</div>
				</div>
			</div>
			<div class="block brdsep">
					<div class="set-baseinfo">
						<table class="tableform" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td>输入手机号:</td>
									<td>
										<input id = "phone" class="ipt" type="text" name="phone" value="">
										<div class="error"><span id="sphone"></span></div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td>问题:</td>
									<td>
										<input id = "answer" class="ipt" readonly="readonly" type="text" name="answer" value="">

									</td>
									<td>(不可更改)</td>
								</tr>
								<tr>
									<td>答案:</td>
									<td>
										<input id = "problem" class="ipt" type="text" name="problem" value="">
										<div class="error"><span id="sanswer"></span></div>
									</td>
									<td>(输入答案)</td>
								</tr>
								<tr>
									<th></th>
									<td>
										<a onclick="history.go(-1)" class="abtn msg-up" target="_self" href="" data-reactid=".0.0.1.1.0.4.0">
											<button type="submit" data-reactid=".0.0.1.1.0.4.0.0">
												<u data-reactid=".0.0.1.1.0.4.0.0.0">点击返回</u>
											</button>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			</div>
		</div>
		</div>
	</div>
<script>
    $(function () {
        $("#phone").blur(function () {
            var phone = $("#phone").val();
            if(phone == 0){
                $("#sphone").html('*手机号不能为空');
                return false;
            }else{
                $("#sphone").html('');
            }
            $.ajax({
                url:'/home/gettel',
                type:'get',
                data:{
                    'phone':phone,
                },
                success:function (data,status,xhr) {
                    if (data.status == 1){
                        $("#answer").val(data.mess);
                    }
                    if (data.status == 2){
                        $("#answer").val(data.mess);
                        return false;
                    }
                },
				error:function (xhr,status,message) {
                    eval("var errors = "+xhr.responseText);
                    if(errors.phone) {
                        $("#answer").val(errors.answer[0]);
                        return false;
					}else{
                        $("#answer").html('');
					}
				},
                dataType:'json',
			});
            return false;
        })
        $("#problem").blur(function () {
            var problem = $("#problem").val();
            var phone = $("#phone").val();

            if(problem == 0){
                $("#sanswer").html('*答案不能为空');
                return false;
            }else{
                $("#sanswer").html('');
            }
            $.ajax({
                url:'/home/getproblem',
                type:'get',
                data:{
                    'problem':problem,
					'phone':phone,
                },
                success:function (data,status,xhr) {
                    if (data.status == 1){
                        $("#sanswer").html('重置后的密码为：'+data.mess);
                    }
                    if (data.status == 2){
                        $("#sanswer").html(data.mess);
                        return false;
                    }
                },
                error:function (xhr,status,message) {
                    eval("var errors = "+xhr.responseText);
                    if(errors.problem) {
                        $("#answer").val(errors.answer[0]);
                        return false;
                    }else{
                        $("#answer").html('');
                    }
                },
                dataType:'json',
            });
            return false;
        })
    })
</script>
</body>
</html>