</div>
	</div>
	<div class="bottom_div">
		<div class="bottom_main">
			<span>
				联系人：李先生&nbsp;&nbsp;&nbsp;&nbsp;
				联系电话：13581641192&nbsp;&nbsp;&nbsp;&nbsp;
				电子邮件：channingbreeze@163.com&nbsp;&nbsp;&nbsp;&nbsp;
				QQ：396417401&nbsp;&nbsp;&nbsp;&nbsp;
				微信号：xin874058
				<?php 
				if(isset($_SESSION['user']) && isset($_SESSION['user']['is_admin'])) {
				?>
				<a href="admin.php">&nbsp;</a>
				<?php 
				}
				?>
			</span>
		</div>
	</div>