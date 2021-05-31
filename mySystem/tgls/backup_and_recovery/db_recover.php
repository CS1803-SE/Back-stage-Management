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
<!--							<input type="text" name="name" required lay-verify="required" placeholder="输入数据库名" autocomplete="off" class="layui-input">-->
<!--						</div>-->
<!--						<button class="layui-btn" lay-submit lay-filter="formDemo">检索</button>-->
<!--					</div>-->
				</form>
			</div>

			<table class="layui-hide" id="demo" lay-filter="test"></table>
			<script type="text/html" id="barDemo">
				<a class="layui-btn layui-btn-sm" lay-event="recovery">还原</a>
				<a class="layui-btn layui-btn-sm" lay-event="delete">删除</a>
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
						,url: '../../application/backup_recovery/getBackupRecord.php'//数据接口
						,parseData: function(res){ //res 即为原始返回的数据
							console.log(res)
						}
					,limit:15
					,page:true
					,method:'post'
						,title: '用户表'
						,totalRow: false //开启合计行
						,cols: [[ //表头
							{field: 'tableName', title: '数据库名', width:200, fixed: 'left'}
							,{field: 'backupTime', title: '备份时间', width:300, sort: true , fixed: 'left'}
							,{field: 'fileName', title: '备份文件名', width:300,  fixed: 'left'}
							,{field: 'filePath', title: '备份路径', width:300,  fixed: 'left'}
							,{fixed: 'right', width: 200, align:'center', toolbar: '#barDemo'}
						]]
					});

					table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
						var data = obj.data //获得当前行数据
								,layEvent = obj.event; //获得 lay-event 对应的值

						if(layEvent === 'recovery'){
							layer.confirm('恢复备份吗?', function(index){
								recoveryTable(data,index,obj);
							});
						}else if(layEvent === 'delete'){
							layer.confirm('要删除这个备份吗?', function(index){
								deleteTable(data,index,obj);
							});

						}
						function deleteTable(data,index,obj){
							$.ajax({
								url: '../../application/backup_recovery/deleteFile.php',    //这个是后台的路由地址
								type: "POST",
								data:{"fileName":data.fileName},//传给后台的值
								dataType: "json",
								success: function(data){
									if(data['status']=="success"){   //从前台取回的状态值
										layer.close(index);
										obj.del();
										//同步更新表格和缓存对应的值
										layer.msg("删除成功", {icon: 6});
									}else{
										layer.msg("删除失败 ", {icon: 5});
									}
								}
							});
						}


						function recoveryTable(data,index,obj){
							$.ajax({
								url: '../../application/backup_recovery/recovery.php',    //这个是后台的路由地址
								type: "POST",
								data:{"fileName":data.fileName},//传给后台的值
								dataType: "json",
								success: function(data){
									if(data['status']=="success"){   //从前台取回的状态值
										layer.close(index);
										//同步更新表格和缓存对应的值
										layer.msg("恢复成功", {icon: 6});
									}else{
										layer.msg("恢复失败 ", {icon: 5});
									}
								}
							});
						}
					});

				});
			</script>
		</div>
	</body>

</html>