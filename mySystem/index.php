<?php
session_start();//启用session
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>

	<!-- 公共样式 开始 -->
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="text/css" href="css/iconfont.css">
	<script type="text/javascript" src="framework/jquery-1.11.3.min.js" ></script>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>
	<!-- 滚动条插件 -->
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css">
	<script src="framework/jquery-ui-1.10.4.min.js"></script>
	<script src="framework/jquery.mousewheel.min.js"></script>
	<script src="framework/jquery.mCustomScrollbar.min.js"></script>
	<script src="framework/cframe.js"></script><!-- 仅供所有子页面使用 -->
	<!-- 公共样式 结束 -->

	<link rel="stylesheet" type="text/css" href="css/frameStyle.css">
	<script type="text/javascript" src="framework/frame.js" ></script>
</head>
<body>

<?php
//判断是否接收到了数据，有，则以SESSION方式登录
if (empty($_SESSION["name"])) {
    echo "<script>alert('未登录！')</script>";
    header("Location: login.html");
}
?>

<!-- 左侧菜单 - 开始 -->
<div class="frameMenu">
	<div class="logo">
		<div class="logoText">
			<h1>后台管理系统</h1>
		</div>
	</div>

	<div class="menu">
		<ul>
			<li>
				<a class="menuFA" href="#" onclick="menuCAClick('tgls/title/qdAPI.html',this)"><i class="iconfont icon-zhishi left"></i>首页</a>
			</li>

			<li>
				<a class="menuFA" href="#"><i class="iconfont icon-liuliangyunpingtaitubiao03 left"></i>用户管理<i class="iconfont icon-dajiantouyou right"></i></a>
				<dl>
					<dt><a href="#" onclick="menuCAClick('tgls/user/user_add.php',this)">添加用户</a></dt>
					<dt><a href="#" onclick="menuCAClick('tgls/user/user_list.php',this)">用户列表</a></dt>
<!--					<dt><a href="#" onclick="menuCAClick('tgls/user/user_role.php',this)">角色管理</a></dt>-->
					<dt><a href="#" onclick="menuCAClick('tgls/user/user_journal.php',this)">管理员日志</a></dt>
				</dl>
			</li>

			<li>
				<a class="menuFA" href="#"><i class="iconfont icon-tubiao202 left"></i>讲解审核<i class="iconfont icon-dajiantouyou right"></i></a>
				<dl>
					<dt><a href="#" onclick="menuCAClick('tgls/examine/unexamine.php',this)">未审核</a></dt>
					<dt><a href="#" onclick="menuCAClick('tgls/examine/alexamine.php',this)">已审核</a></dt>
				</dl>
			</li>

			<li>
				<a class="menuFA" href="#"><i class="iconfont icon-yunying left"></i>数据管理<i class="iconfont icon-dajiantouyou right"></i></a>
				<dl>
					<dt><a href="#" onclick="menuCAClick('tgls/data/sys_data.php',this)">博物馆</a></dt>
					<dt><a href="#" onclick="menuCAClick('tgls/data/user_remark.php',this)">用户点评</a></dt>
					<dt><a href="#" onclick="menuCAClick('tgls/data/museum_treasure.php',this)">藏品信息</a></dt>
					<dt><a href="#" onclick="menuCAClick('tgls/data/museum_news.php',this)">新闻</a></dt>
				</dl>
			</li>
			<li>
				<a class="menuFA" href="#"><i class="iconfont icon-icon1 left"></i>数据备份和恢复<i class="iconfont icon-dajiantouyou right"></i></a>
				<dl>
					<dt>
                        <dt><a href="#" onclick="menuCAClick('tgls/backup_and_recovery/db_backup.php',this)">数据库备份</a></dt>
                        <dt><a href="#" onclick="menuCAClick('tgls/backup_and_recovery/db_recover.php',this)">数据库恢复</a></dt>
					</dt>
				</dl>
			</li>
		</ul>
	</div>
</div>
<!-- 左侧菜单 - 结束 -->

<div class="main">
	<!-- 头部栏 - 开始 -->
	<div class="frameTop">
		<img class="jt" src="images/top_jt.png"/>
		<div class="topMenu">
			<ul>
				<li><a href="#"><i class="iconfont icon-yonghu1"></i>管理员</a></li>
				<li><a href="#" onclick="menuCAClick('tgls/title/modify_password.php',this)"><i class="iconfont icon-xiugaimima"></i>修改密码</a></li>

				 <li><a href="application/administration/logout.php" ><i class="iconfont icon-xiugaimima"></i>注销</a></li>
			</ul>
		</div>
	</div>
	<!-- 头部栏 - 结束 -->

	<!-- 核心区域 - 开始 -->
	<div class="frameMain">
		<div class="title" id="frameMainTitle">
			<span><i class="iconfont icon-xianshiqi"></i>首页</span>
		</div>
		<div class="con">
			<iframe id="mainIframe" src="tgls/title/qdAPI.html" scrolling="no"></iframe>
		</div>
	</div>
	<!-- 核心区域 - 结束 -->
</div>
</body>


</html>