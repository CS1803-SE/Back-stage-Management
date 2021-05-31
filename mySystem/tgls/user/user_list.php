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
            <table class="layui-hide" id="demo" lay-filter="test"></table>
            <script type="text/html" id="barDemo">
				<a class="layui-btn layui-btn-sm" lay-event="delete">删除</a>
                <a class="layui-btn layui-btn-sm" lay-event="edit">修改</a>
            </script>
			<script>



				layui.use(['laypage', 'layer'], function() {
					
					var laypage = layui.laypage,
						layer = layui.layer,
					    table = layui.table,
                        element = layui.element;
                    
                     /*    //下拉菜单
					//监听Tab切换
                    element.on('tab(demo)', function(data){
                        layer.tips('切换了 '+ data.index +'：'+ this.innerHTML, this, {
                            tips: 1
                        });
                    });
*/
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
    ,url: '../../application/user/user_list.php'//数据接口
    ,method:'post'
    ,parseData: function(res){ //res 即为原始返回的数据
        console.log(res);
    }
    ,
    limit:15
    	,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
    	     // layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'], //自定义分页布局
    	      curr: 1 //设定初始在第 5 页
    	      ,groups: 1 //只显示 1 个连续页码
    	      ,first: false //不显示首页
    	      ,last: false //不显示尾页
    	      
    	    },
    cols: [[ //表头
        {type: 'checkbox', fixed: 'left'}
        ,{field: 'NickName', title: '昵称', width:80, sort: true, fixed: 'left', totalRowText: '合计：'}
        ,{field: 'IDNumber', title: '身份证号', width:180}
        ,{field: 'Name', title: '姓名', width: 90, sort: true, totalRow: true}
        ,{field: 'Permission', title: '用户权限', width:120, sort: true}
        ,{field: 'AccountNumber', title: '账号', width: 80, sort: true, totalRow: true}
        ,{field: 'Password', title: '密码', width: 80, sort: true, totalRow: true}
        ,{field: 'PhoneNumber', title: '电话号码', width:150}
        ,{field: 'E_mail', title: '邮箱', width: 200}
        ,{field: 'State', title: '状态', width: 100}
        ,{fixed: 'right', width: 200, align:'center', toolbar: '#barDemo'}
    ]]
 });
                //监听行工具事件
                    table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                        var data = obj.data //获得当前行数据
                            ,layEvent = obj.event; //获得 lay-event 对应的值
                        if(layEvent === 'delete'){
                            layer.confirm('真的删除行么', function(index){
                                deleteUser(data,index,obj);
                            })
                            }
                        else if(layEvent=='edit'){
                            showEdit(data);
                        }

                        function deleteUser(data,index,obj){
                            $.ajax({
                                url: '../../application/user/user_list_delete.php',    //这个是后台的路由地址
                                type: "POST",
                                data:{"AccountNumber":data.AccountNumber},//传给后台的值
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
                        function showEdit(datas) {

                            var editHtml = '<form id="form1" class="layui-form" method="post" action="../../application/user/user_edit.php" style="width:460px; margin-top: 20px;">\
                           <div class="layui-form-item">\
                             <label class="layui-form-label">昵称</label>\
                             <div class="layui-input-block">\
                               <input type="text" name="NickName" lay-verify="title" value="'+datas.NickName+'" autocomplete="off" placeholder="请输入" class="layui-input">\
                             </div>\
                           </div>\
                           <div class="layui-form-item">\
                             <label class="layui-form-label">身份证号</label>\
                             <div class="layui-input-block">\
                               <input type="text" name="IDNumber" value="'+datas.IDNumber+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                             </div>\
                           </div>\
                           <div class="layui-form-item">\
                             <label class="layui-form-label">姓名</label>\
                             <div class="layui-input-block">\
                               <input type="text" name="Name" value="'+datas.Name+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                             </div>\
                           </div>\
                           <div class="layui-form-item">\
                             <label class="layui-form-label">用户权限</label>\
                             <div class="layui-input-block">\
                               <input type="text" name="Permission" value="'+datas.Permission+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                             </div>\
                           </div>\
                           <div class="layui-form-item">\
                             <label class="layui-form-label">账号</label>\
                             <div class="layui-input-block">\
                               <input type="text" name="AccountNumber" value="'+datas.AccountNumber+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                             </div>\
                           </div>\
                           <div class="layui-form-item">\
                           <label class="layui-form-label">密码</label>\
                           <div class="layui-input-block">\
                             <input type="text" name="Password" value="'+datas.Password+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                           </div>\
                         </div>\
                         <div class="layui-form-item">\
                         <label class="layui-form-label">电话号码</label>\
                         <div class="layui-input-block">\
                           <input type="text" name="PhoneNumber" value="'+datas.PhoneNumber+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                         </div>\
                       </div>\
                       <div class="layui-form-item">\
                       <label class="layui-form-label">邮箱</label>\
                       <div class="layui-input-block">\
                         <input type="text" name="E_mail" value="'+datas.E_mail+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
                       </div>\
                     </div>\
                     <div class="layui-form-item">\
                     <label class="layui-form-label">状态</label>\
                     <div class="layui-input-block">\
                       <input type="text" name="State" value="'+datas.State+'" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">\
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
                                   // var params ={"museumID",}
                                    $.ajax({
                                        url: '../../application/user/user_edit.php',    //这个是后台的路由地址
                                        type: "POST",
                                        data:$('#form1').serialize(),//传给后台的值
                                        dataType: "json",
                                        success: function(data){
                                            layer.close(layIndex);
                                            if(data['status']=="success"){
                                            	 table.reload();   //从前台取回的状态值
                                            	   window.location.reload();
                                                layer.msg("修改成功", {icon: 6});
                                            }else{
                                            	 table.reload();
                                                layer.msg("修改失败 ", {icon: 5});
                                            }
                                         
                                        }
                                    });
                                   
                                }
                            });
                        }
                    } );
                          
                        


                    });

			</script>
		</div>
	</body>

</html>