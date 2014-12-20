<?php 
	include_once 'partials/header.php';
?>
<div class="service_div">
	<span>全新交互式建站方式</span>
	<div>——构建真正属于你自己的网站</div>
</div>
<div class="mysite_div">
	<?php
		session_start();
		if(isset($_SESSION['user'])) {
	?>
	<button class="mysite_btn" id="mysite_btn">我的网站</button>
	<?php
		} else {
	?>
	<button class="mysite_btn" id="login_btn">登陆</button>
	<?php
		}
	?>
</div>
<div class="steps_div">
	<ul>
		<li><span data-dir="one">1.提交需求</span></li>
		<li><span data-dir="two">2.确定样式</span></li>
		<li><span data-dir="three">3.完成功能</span></li>
		<li><span data-dir="four">4.全站测试</span></li>
		<li><span data-dir="five">5.网站上线</span></li>
	</ul>
	<div class="steps_info" id="one">
		<span>我们会在收到需求后，通过QQ、邮件和电话与您联系确定需求细节</span>
	</div>
	<div class="steps_info" id="two">
		<span>网站结构与样式设计过程中，您可以随时查阅，发现不合心意的地方可随时通知我们进行修改</span>
	</div>
	<div class="steps_info" id="three">
		<span>每一个功能设计好后，我们会通知您，如果与您预期不符，可随时通知我们进行修改</span>
	</div>
	<div class="steps_info" id="four">
		<span>网站完成后，我们会对网站进行完整的测试，如果需要，可提供专业测试报告</span>
	</div>
	<div class="steps_info" id="five">
		<span>测试通过后，我们负责您的网站上线和维护</span>
	</div>
</div>
<?php 
	include_once 'partials/footer.php';
?>
<div id="back" class="back_overlay"></div>
	<div id="login_dialog" class="login_dialog">
		<a class="close_btn" id="close_btn" href="#">X</a>
		<h1>请登陆</h1>
		<span class="register_span">还没账号？<a id="register_btn">立即注册</a></span>
		<div class="login_dialog_div">
		<form id="login_form" action="#" enctype="multipart/form-data" method="post">
			<table>
				<tr><td height="50px"><span>用户名：</span></td><td><input type="text" name="username" placeholder="请输入邮箱账号"></input></td></tr>
				<tr><td height="50px"><span>密　码：</span></td><td><input type="password" name="password" placeholder="请输入密码"></input></td></tr>
				<tr><td height="100px" colspan=2 align=center><input type="submit" id="submit_login" value="登陆"></input></td></tr>
			</table>
		</form>
		</div>
	</div>
	<div id="register_dialog" class="register_dialog">
		<a class="close_btn" id="close_btn" href="#">X</a>
		<h1>请注册</h1>
		<div class="register_dialog_div">
		<form id="register_form" action="#" enctype="multipart/form-data" method="post">
			<table>
				<tr><td height="50px"><span>用户名：</span></td><td><input type="text" name="username" placeholder="请输入邮箱账号"></input></td><td></td></tr>
				<tr><td height="50px"><span>密　码：</span></td><td><input id="password" type="password" name="password" placeholder="请输入密码"></input></td><td></td></tr>
				<tr><td height="50px"><span>确认密码：</span></td><td><input id="repassword" type="password" placeholder="请重新输入密码"></input></td><td></td></tr>
				<tr><td height="100px" colspan=2 align=center><input type="submit" id="submit_register" value="注册"></input></td></tr>
			</table>
		</form>
		</div>
	</div>
	<script>
        seajs.use("modules/index");
    </script>
</body>
