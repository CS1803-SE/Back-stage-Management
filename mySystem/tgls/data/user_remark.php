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
       <!--   <script type="text/javascript" src="../../framework/jquery.form.min.js.js"></script>-->
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
		<div class="cBody">
			<div class="console">
				<form class="layui-form" action="">
				</form>
			</div>


            <table class="layui-hide" id="demo" lay-filter="test"></table>
            <script type="text/html" id="barDemo">
                <a class="layui-btn layui-btn-sm" lay-event="delete">删除</a>
            </script>

			<script>
                layui.use(['laypage', 'layer'], function() {
                    var laypage = layui.laypage,
                        layer = layui.layer,
                        table = layui.table,
                        element = layui.element;

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
                        ,url: '../../application/user/user_remark.php'//数据接口
                        ,parseData: function(res){ //res 即为原始返回的数据
                            console.log(res)
                        }
                    ,limit:15
                    	,method:'post'
                        ,title: '用户评论表'
                        ,page: true //开启分页
                        //,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
                        ,totalRow: false //开启合计行
						,cols: [[ //表头
						    {field: 'remarkID', title: '序号', width:80, sort: true, fixed: 'left'}
							,{field: 'museumName', title: '博物馆名称', width:200, sort: true, fixed: 'left'}
							,{field: 'NickName', title: '昵称', width:200,  fixed: 'left'}
							,{field: 'exhi_point', title: '展览评分', width: 100}
							,{field: 'server_point', title: '服务评分', width:100}
							,{field: 'enviro_point', title: '环境评分', width: 100}
							,{field:'pinglun', title: '评论',width:300}
					,{fixed: 'right', width: 100, align:'center', toolbar: '#barDemo'}
						]]
					});

                    table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                        var data = obj.data//获得当前行数据
                            ,layEvent = obj.event;//获得 lay-event 对应的值

                        if(layEvent === 'delete'){
                            layer.confirm('真的删除行么', function(index){
                                deluser(data,index,obj);
                                table.reload();
                            });
                        }

                        //删除数据的函数
                        function deluser(data,index,obj){
                            $.ajax({
                                url: '../../application/user/user_remark_delete.php',    //这个是后台的路由地址
                                type: "POST",
                                data:{"remarkID":data.remarkID},//传给后台的值
                                dataType: "json",
                                success: function(data){
                                    if(data['status']=="success"){   //从前台取回的状态值
                                        layer.close(index);
                                        //同步更新表格和缓存对应的值
                                        obj.del();
                                        layer.msg("删除成功", {icon: 6});
                                    }else{
                                        layer.msg("删除失败 ", {icon: 5});
                                    }
                                }
                            });
                        }

                        //修改数据的函数
                       
                            });              
                    });


			</script>
		</div>
	</body>
</html>