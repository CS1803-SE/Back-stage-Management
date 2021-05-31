<?php
session_start();//启用session
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>后台管理系统</title>

		<!-- 公共样式 开始 -->
		<link rel="stylesheet" type="text/css" href="../../css/base.css">
		<link rel="stylesheet" type="text/css" href="../../css/iconfont.css">
		<script type="text/javascript" src="../../framework/jquery-1.11.3.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../../layui/css/layui.css">
		<script type="text/javascript" src="../../layui/layui.js"></script>
		<!-- 滚动条插件 -->
		<link rel="stylesheet" type="text/css" href="../../css/jquery.mCustomScrollbar.css">
		<script src="../../framework/jquery-ui-1.10.4.min.js"></script>
		<script src="../../framework/jquery.mousewheel.min.js"></script>
		<script src="../../framework/jquery.mCustomScrollbar.min.js"></script>
		<script src="../../framework/cframe.js"></script><!-- 仅供所有子页面使用 -->
		<!-- 公共样式 结束 -->
		
		<style>
			.layui-form{
				margin-right: 30%;
			}
		</style>
	</head>

	<body>
    <?php
    //判断是否接收到了数据，有，则以SESSION方式登录
    if (empty($_SESSION["name"])) {
        echo "<script>alert('未登录！')</script>";
        header("Location: ../../login.html");
    }
    ?>
		<div class="cBody">
			<form id="addForm" class="layui-form" action="">
				<div class="layui-form-item">
					<label class="layui-form-label">身份证号</label>
					<div class="layui-input-inline shortInput">
						<input type="text" name="identity" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">姓名</label>
					<div class="layui-input-inline shortInput">
						<input type="text" name="userName" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">昵称</label>
					<div class="layui-input-inline shortInput">
						<input type="text" name="nickName" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">账号</label>
					<div class="layui-input-inline shortInput">
						<input type="text" name="loginName" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">密码</label>
					<div class="layui-input-inline shortInput">
						<input type="password" name="password" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">确认密码</label>
					<div class="layui-input-inline shortInput">
						<input type="password" name="password" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">电话</label>
					<div class="layui-input-inline shortInput">
						<input type="text" name="phone" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">邮箱</label>
					<div class="layui-input-inline shortInput">
						<input type="text" name="email" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">备注</label>
					<div class="layui-input-block">
						<textarea name="remarks" placeholder="请输入内容" class="layui-textarea"></textarea>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">状态</label>
					<div class="layui-input-block">
						<input type="radio" name="state" value="normal" title="正常" checked>
						<input type="radio" name="state" value="forbidden" title="禁言">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">角色</label>
					<div class="layui-input-block">
						<input type="radio" name="role" value="common" title="普通用户" checked>
						<input type="radio" name="role" value="admin" title="管理员">
						<input type="radio" name="role" value="superadmin" title="超级管理员">
					</div>
				</div>

				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit lay-filter="submitBut">添加</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
			<script>
				//Demo
				layui.use('form', function(){
					var form = layui.form;
					//监听提交
					form.on('submit(submitBut)', function(data){
						//layer.msg(JSON.stringify(data.field));
						$.ajax({
							url: '../../application/user/user_add.php',    //这个是后台的路由地址
							type: "POST",
							data:data.field,//传给后台的值
							dataType: "json",
							success: function(data){
								if(data['status']=="success"){   //从前台取回的状态值
									layer.msg("添加成功", {icon: 6});
									
								}else{
									layer.msg("添加失败", {icon: 5});
								}
							}
						});
						
						return false;
					});
                      
				});
			</script>
		</div>
	</body>
</html>