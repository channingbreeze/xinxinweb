<?php 
	include_once 'partials/header.php';
?>
<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header('Location: index.php');	
	}
?>
<div class="myweb_left_nav"/>
	<ul id="myweb_ul">
	</ul>
	<button id="add_web">新建网站</button>
</div>
<div class="myweb_none">
	<span>您还没有网站，赶紧新建网站吧！</span>
</div>
<div class="myweb_content">
	<div class="myweb_top_info"/>
		<span>调试域名：<span id="debug_domain"></span>&nbsp;&nbsp;&nbsp;&nbsp;密码：<span id="debug_password" class="password"></span></span>
	</div>
	<div class="myweb_status_div"/>
		<ul id="mystatus_ul">
			<li data-dir="0">提交需求</li>
			<li data-dir="1">确定样式</li>
			<li data-dir="2">完成功能</li>
			<li data-dir="3">全站测试</li>
			<li data-dir="4">网站上线</li>
		</ul>
	</div>
	<div class="myweb_main_mess"/>
		<h1 id="mess_title">提交需求</h1>
		<div id="mess_content" class="message">
			
		</div>
	</div>
</div>
<?php 
	include_once 'partials/footer.php';
?>
<div id="back" class="back_overlay"></div>
	<div id="info_dialog" class="info_dialog">
		<a class="close_btn" id="close_btn" href="#">X</a>
		<h1>第一次吧？</h1>
		<span class="info_span">请先填写个人信息</span>
		<div class="info_div">
		<form id="info_form" action="#" enctype="multipart/form-data" method="post">
			<table>
				<tr><td height="50px"><span>姓　名：</span></td><td><input type="text" name="truename" placeholder="请输入真实姓名"></input></td></tr>
				<tr><td height="50px"><span>性　别：</span></td><td align="left"><input type="radio" name="gender" value="0" checked><span>&nbsp;男</span></input><input type="radio" name="gender" value="1"><span>&nbsp;女</span></input></td></tr>
				<tr><td height="50px"><span>手　机：</span></td><td><input type="text" name="mobile" placeholder="请输入手机号"></input></td></tr>
				<tr><td height="50px"><span>&nbsp;Q　Q：&nbsp;</span></td><td><input type="text" name="qq" placeholder="请输入QQ"></input></td></tr>
				<tr><td height="100px" colspan=2 align=center><input type="submit" id="submit_info" value="提交"></input></td></tr>
			</table>
		</form>
		</div>
	</div>
	<div id="demand_dialog" class="demand_dialog">
		<a class="close_btn" id="close_btn" href="#">X</a>
		<h1>需求简介</h1>
		<div class="demand_div">
		<form id="demand_form" action="#" enctype="multipart/form-data" method="post">
			<table>
				<tr><td height="100px"><span>网站名称：</span></td><td><input type="text" name="website_name" placeholder="请输入网站名称"></input></td></tr>
				<tr><td height="100px"><span>需求：</span></td><td><textarea name="demand" placeholder="请输入需求简介"></textarea></td></tr>
				<tr><td height="100px" colspan=2 align=center><input type="submit" id="submit_demand" value="提交"></input></td></tr>
			</table>
		</form>
		</div>
	</div>
	<script>
	<?php
		if(isset($_SESSION['user'])) {
	?>
		var USERID='<?php echo $_SESSION['user']['userid'];?>';
		var USERNAME='<?php echo $_SESSION['user']['username'];?>';
	<?php
		}
	?>
        seajs.use("modules/myweb");
    </script>
</body>
