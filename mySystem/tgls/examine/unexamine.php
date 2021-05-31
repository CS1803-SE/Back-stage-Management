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
<!--		<script type="text/javascript" src="../../framework/jquery-1.11.3.min.js"></script>-->
		<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.min.js"></script>
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
<!--					<div class="layui-form-item">-->
<!--						<div class="layui-input-inline">-->
<!--							<input type="text" name="nickName" required lay-verify="required" placeholder="输入用户昵称" autocomplete="off" class="layui-input">-->
<!--						</div>-->
<!--						<button class="layui-btn" lay-submit lay-filter="formDemo">检索</button>-->
<!--					</div>-->
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
								dropdown = layui.dropdown, //下拉菜单
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
							,url: '../../application/examine/unExamine.php'//数据接口
							,parseData: function(res){ //res 即为原始返回的数据
								console.log(res)
							}
						,page:true
						,limit:15
						,method:'post'
							,title: '用户表'
							,initSort: {
								field: 'State' //排序字段，对应 cols 设定的各字段名
								,type: 'desc' //排序方式  asc: 升序、desc: 降序、null: 默认排序
								,page: true //开启分页
							}
							//,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
							,sort : true
							,totalRow: false //开启合计行
							,cols: [[ //表头
								{field: 'NickName', title: '昵称', width:80, sort: true, fixed: 'left'}
								,{field: 'AccountNumber', title: '账号', width:300,  fixed: 'left'}
								,{field: 'VideoName', title: '讲解审核', width: 200}
								,{field: 'Intro', title: '视频介绍', width:200}
								,{field: 'Address', title: '视频链接', width: 300, totalRow: true,templet:
											'<div><a href="{{d.Address}}" class="layui-table-link" target="_blank">{{d.Address}}</a></div>'}
								,{fixed: 'right', width: 200, align:'center', toolbar: '#barDemo'}
							]]

						});


						table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
							var myData = obj.data//获得当前行数据
									,layEvent = obj.event;//获得 lay-event 对应的值


							 if(layEvent === 'exam') {
								 dropdown.render({
									 elem: this //触发事件的 DOM 对象
									 , show: true //外部事件触发即显示
									 , data: [{
										 title: '不通过'
										 , id: 'yes'
									 }, {
										 title: '通过'
										 , id: 'no'
									 }]
									 , click: function (menuData) {
										 if (menuData.id === 'yes') {
											 layer.confirm('真的不通过吗?', function (index) {
												 obj.del(); //删除对应行（tr）的DOM结构
												 layer.close(index);
												 //向服务端发送删除指令
												 $.ajax({
													 url: '../../application/examine/checkPassed.php',    //这个是后台的路由地址
													 type: "POST",
													 data:{"state":'1',"VideoName":myData['VideoName']},//传给后台的值
													 dataType: "json",
													 success: function(data){
														 if(data['status']=="success"){   //从前台取回的状态值
															 layer.msg("审核成功", {icon: 6});
														 }else{
															 layer.msg("审核失败", {icon: 5});
														 }
													 }
												 });
											 });
										 } else if (menuData.id === 'no') {
											 layer.confirm('真的通过吗?', function (index) {
												 obj.del(); //删除对应行（tr）的DOM结构
												 layer.close(index);
												 //向服务端发送删除指令
												 $.ajax({
													 url: '../../application/examine/checkPassed.php',    //这个是后台的路由地址
													 type: "POST",
													 data:{"state":'0',"VideoName":myData['VideoName']},//传给后台的值
													 dataType: "json",
													 success: function(data){
														 if(data['status']=="success"){   //从前台取回的状态值
															 layer.msg("审核成功", {icon: 6});
														 }else{
															 layer.msg("审核失败", {icon: 5});
														 }
													 }
												 });
											 });
										 }
									 }
								 });
							 }
							 tale.reload();

						});

					});



				</script>
			</div>
	</body>
</html>
