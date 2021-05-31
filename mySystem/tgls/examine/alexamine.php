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
	<div class="console">
		<form class="layui-form" action="">
<!--			<div class="layui-form-item">-->
<!--				<div class="layui-input-inline">-->
<!--					<input type="text" name="nickName" required lay-verify="required" placeholder="输入用户昵称" autocomplete="off" class="layui-input">-->
<!--				</div>-->
<!--				<button class="layui-btn" lay-submit lay-filter="formDemo">检索</button>-->
<!--			</div>-->
		</form>
	</div>

	<table class="layui-hide" id="demo" lay-filter="test"></table>
	<script type="text/html" id="barDemo">
		<a class="layui-btn layui-btn-sm" lay-event="exam">审核</a>
	</script>
	<script>
		layui.use(['laypage', 'layer'], function() {
			var laypage = layui.laypage,
					layer = layui.layer,
					table = layui.table;

			//总页数大于页码总数
			laypage.render({
				elem: 'pages'
				,count: 100
				,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
				,jump: function(obj){
					console.log(obj)
				}
			});

			table.render({
				elem: '#demo'
				,height: 800
				,url: '../../application/examine/examine.php'//数据接口
				,parseData: function(res){ //res 即为原始返回的数据
					console.log(res)
				}
				,title: '用户表'
				,page:true
				,limit:15
				,totalRow: false //开启合计行
				,method:'post'
				,cols: [[ //表头
					{field: 'NickName', title: '昵称', width:80, sort: true, fixed: 'left'}
					,{field: 'AccountNumber', title: '账号', width:300,  fixed: 'left'}
					,{field: 'VideoName', title: '讲解审核', width: 200}
					,{field: 'Intro', title: '视频介绍', width:200}
					,{field: 'Address', title: '视频链接', width: 300, totalRow: true}
					,{field: 'State', title: '状态', width: 150,sort:true}
				]]
			});

		});


	</script>
</div>
</body>

</html>