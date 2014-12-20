define(function(require, exports, module){

	require('jquery');
	
	$('.steps_div').find('li').on('mouseenter', function() {
		$('#'+$(this).find('span').data('dir')).css('display', 'block');
	}).on('mouseleave', function() {
		$('#'+$(this).find('span').data('dir')).css('display', 'none');
	});
	
	$('#login_btn').on('click', function() {
		$('#back').css('display', 'block');
		$('#login_dialog')
		.animate(
			{top : '220px'},
			200,
			'swing'
		)
		.animate(
			{top : '180px'},
			100,
			'swing'
		)
		.animate(
			{top : '200px'},
			100,
			'swing'
		);
	});
	
	$('#login_dialog').find('#close_btn').on('click', function(e) {
		e.preventDefault();
		$('#login_dialog')
		.animate(
			{top : '240px'},
			100,
			'swing'
		)
		.animate(
			{top : '-320px'},
			300,
			'swing',
			function(){
				$('#back').css('display', 'none');
			}
		);
	});
	
	$('#register_btn').on('click', function(e) {
		e.preventDefault();
		$('#login_dialog')
		.animate(
			{top : '240px'},
			100,
			'swing'
		)
		.animate(
			{top : '-320px'},
			300,
			'swing',
			function() {
				$('#register_dialog')
				.animate(
					{top : '180px'},
					200,
					'swing'
				)
				.animate(
					{top : '140px'},
					100,
					'swing'
				)
				.animate(
					{top : '160px'},
					100,
					'swing'
				);
			}
		);
	});
	
	$('#register_dialog').find('#close_btn').on('click', function(e) {
		e.preventDefault();
		$('#register_dialog')
		.animate(
			{top : '200px'},
			100,
			'swing'
		)
		.animate(
			{top : '-380px'},
			300,
			'swing',
			function(){
				$('#back').css('display', 'none');
			}
		);
	});
	
	$('#submit_login').on('click', function(e) {
		e.preventDefault();
		$.post('inter/userLogin.php', $('#login_form').serialize(), function(result) {
			if(result == "true") {
				window.location.href = "myweb.php";
			}else{
				window.alert('用户名不存在或密码错误！');
			}
		});
	});
	
	$('#submit_register').on('click', function(e) {
		e.preventDefault();
		if($('#password').val() != $('#repassword').val()) {
			window.alert('两次密码不一致');
		} else {
			$.post('inter/userRegister.php', $('#register_form').serialize(), function(result) {
				if(result == "true") {
					window.location.href = "myweb.php";
				} else if(result == "empty"){
					window.alert('信息不全');
				} else {
					window.alert('用户名已存在');
				}
			});
		}
	});
	
	$('#mysite_btn').on('click', function(e) {
		window.location.href = "myweb.php";
	});

});
