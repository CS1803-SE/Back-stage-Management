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
  <a class="layui-btn layui-btn-sm" lay-event="edit">修改</a>
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
                        ,url: '../../application/museumData/museum_news.php'//数据接口
                        ,parseData: function(res){ //res 即为原始返回的数据
                            console.log(res)
                        }
                    ,limit:15
                    	,method:'post'
                        ,title: '藏品'
                        ,page: true //开启分页
                        //,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
                        ,totalRow: false //开启合计行
                        ,cols: [[ //表头
                                  {field: 'id', title: '新闻编号', width:80, sort: true, fixed: 'left'}
                                  ,{field: 'museum', title: '博物名称', width:80,  fixed: 'left'}
                                  ,{field: 'title2', title: '标题', width: 300}
                                  ,{field: 'author', title: '作者', width: 200, totalRow: true}
                                  ,{field: 'time', title: '发布时间', width:200}
                                  ,{field: 'content', title: '内容', width:200}
                                  ,{field: 'url', title: '链接', width: 150,templet:
                                          '<div><a href="{{d.url}}" class="layui-table-link" target="_blank">{{d.url}}</a></div>'}
                                  ,{field: 'emotions', title: 'emotions', width:200}
                                   ,{fixed: 'right', width: 200, align:'center', toolbar: '#barDemo'}
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
                        else if(layEvent === 'edit'){
                            showEdit(data);
                        }
                        //删除数据的函数
                        function deluser(data,index,obj){
                            $.ajax({
                                url: '../../application/museumData/museum_news_delete.php',    //这个是后台的路由地址
                                type: "POST",
                                data:{"id":data.id},//传给后台的值
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
                        function showEdit(datas) {

                            var editHtml = '<form id="form1" class="layui-form" method="post" action="../../application/museumData/sys_data_edit.php" style="width:460px; margin-top: 20px;">\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">新闻编号</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="id" lay-verify="title" value="'+datas.id+'" autocomplete="off" placeholder="请输入新闻编号" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">博物名称</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="museum" value="'+datas.museum+'" lay-verify="title" autocomplete="off" placeholder="请输入博物名称" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">标题</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="title2" value="'+datas.title2+'" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">作者</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="author" value="'+datas.author+'" lay-verify="title" autocomplete="off" placeholder="请输入作者" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">发布时间</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="time" value="'+datas.time+'" lay-verify="title" autocomplete="off" placeholder="请输入发布时间" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">内容</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="content" value="'+datas.content+'" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">链接</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="url" value="'+datas.url+'" lay-verify="title" autocomplete="off" placeholder="请输入链接" class="layui-input">\
                                     </div>\
                                   </div>\
                                   <div class="layui-form-item">\
                                     <label class="layui-form-label">emotions</label>\
                                     <div class="layui-input-block">\
                                       <input type="text" name="emotions" value="'+datas.emotions+'" lay-verify="title" autocomplete="off" placeholder="请输入emotions" class="layui-input">\
                                     </div>\
                                   </div>\
                               </form>';

                            layer.open({
                                type: 1,
                                title: '编辑',
                                content: editHtml,
                                area: ['500px', '420px'],
                                btn: ['提交', '取消'],
                                yes: function (layIndex) {
                                    $.ajax({
                                        url: '../../application/museumData/news_edit.php',    //这个是后台的路由地址
                                        type: "POST",
                                        data:$('#form1').serialize(),//传给后台的值
                                        dataType: "json",
                                        success: function(data){
                                            layer.close(layIndex);
                                            if(data['status']=="success"){
                                                table.reload();   //从前台取回的状态值
                                                layer.msg("修改成功", {icon: 6});
                                                window.location.reload();
                                            }else{
                                                table.reload();
                                                layer.msg("修改失败 ", {icon: 5});
                                            }
                                         
                                        }
                                    });

                                }
                            });
                        }                    
                    });
				});
			</script>
		</div>
	</body>
</html>