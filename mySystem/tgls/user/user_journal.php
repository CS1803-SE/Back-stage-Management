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
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <div class="addRole">
                        <form id="addForm" class="layui-form" action="">
                            <div class="layui-form-item">
                                <label class="layui-form-label">管理员姓名</label>
                                <div class="layui-input-inline shortInput">
                                    <input type="text" name="Name" autocomplete="off" class="layui-input">
                                </div>
                            </div>

<!--                            <div class="layui-form-item">-->
<!--                                <label class="layui-form-label">日期</label>-->
<!--                                <div class="layui-input-inline shortInput">-->
<!--                                    <input type="data" id="txtData" />-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">日志</label>
                                <div class="layui-input-block">
                                    <textarea name="Log" placeholder="请输入内容" class="layui-textarea"></textarea>
                                </div>
                            </div>
							
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="submitBut">添加日志</button>
<!--                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </form>

<!--            <table class="layui-table">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th>角色</th>-->
<!--                    <th>操作</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--            </table>-->
            <table class="layui-hide" id="demo" lay-filter="test"></table>
            <script type="text/html" id="barDemo">
                <a class="layui-btn layui-btn-sm" lay-event="delete">删除</a>
            </script>
			
<!--			 layUI 分页模块-->
<!--			<div id="pages"></div>-->
			<script>
				layui.use(['laypage', 'layer','form'], function() {
					var laypage = layui.laypage,
						layer = layui.layer,
                        table = layui.table,
                        form = layui.form,
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
                        ,height: 500
                        ,url: '../../application/user/user_journal.php'//数据接口
                        ,parseData: function(res){ //res 即为原始返回的数据
                            console.log(res)
                        }
                        ,title: '管理员日志表'
                        ,page: true //开启分页
                        ,totalRow: false //开启合计行
                        ,method:'post'
                        ,cols: [[ //表头
                            {type: 'checkbox', fixed: 'left'}
                            ,{field: 'Name', title: '管理员姓名', width:200, sort: true, fixed: 'left'}
                            ,{field: 'Time', title: '日期', width:200, sort:true }
                            ,{field: 'Log', title: '日志', width: 200}
                            ,{fixed: 'right', width: 100, align:'center', toolbar: '#barDemo'}
                        ]]
                    });


                    table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                        var data = obj.data //获得当前行数据
                            ,layEvent = obj.event; //获得 lay-event 对应的值
                        if(layEvent === 'delete'){
                            layer.confirm('真的删除行么', function(index){
                                deluser(data,index,obj);
                            });
                        }

                        function deluser(data,index,obj){
                            $.ajax({
                                url: '../../application/user/user_journal_delete.php',    //这个是后台的路由地址
                                type: "POST",
                                data:{"Time":data.Time},//传给后台的值
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
                          table.reload();
                        }

                    });

                    form.on('submit(submitBut)', function(data){
                        layer.msg(JSON.stringify(data.field));
                        $.ajax({
                            url: '../../application/user/user_journal_add.php',    //这个是后台的路由地址
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
                        form.reload(); 
                        return false;
                    });


                });



			</script>
		</div>
	</body>

</html>