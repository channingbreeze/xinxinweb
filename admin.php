<!DOCTYPE html>
<head>
	<meta charset=utf-8 />
	<title>欣欣网站制作</title>
<?php 
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
} else if(!isset($_SESSION['user']['is_admin'])) {
	header("Location: index.php");
}
	include_once 'partials/header.php';
?>
<div id="admin_user" class="admin_user">
<h1>Welcome to admin page</h1>
<div id="user_table" class="admin_user_table"></div>
<div id="user_pagination" class="admin_user_pagination"></div>
</div>
<div id="admin_web" class="admin_web">
<div class="myweb_left_nav">
	<ul id="myweb_ul">
	</ul>
	<button id="back_button">返回</button>
</div>
<div class="myweb_none">
	<span>没有网站</span>
</div>
<div class="myweb_content">
	<div class="myweb_top_info">
		<span>调试域名：<input type="text" id="debug_domain" />&nbsp;&nbsp;&nbsp;&nbsp;密码：<input type="text" id="debug_password" /></span>
	</div>
	<div class="myweb_status_div">
		<ul id="mystatus_ul">
			<li data-dir="0">提交需求</li>
			<li data-dir="1">确定样式</li>
			<li data-dir="2">完成功能</li>
			<li data-dir="3">全站测试</li>
			<li data-dir="4">网站上线</li>
		</ul>
	</div>
	<div class="myweb_main_mess">
		<h1 id="mess_title">提交需求</h1>
		<textarea id="mess_content" class="message" cols="60" rows="15"></textarea>
	</div>
</div>
</div>
<?php 
	include_once 'partials/footer.php';
?>
<script>
        seajs.use("modules/admin");
    </script>
</body>
