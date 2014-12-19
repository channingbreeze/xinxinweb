define(function(require, exports, module){

	require('jquery');
	require('handlebars');
	
	var titles = ['提交需求', '确定样式', '完成功能', '全站测试', '网站上线'];
	var curWebsiteId = 0;
	var statusId = 0;
	var status;
	
	var refreshStatusById = function() {
		$('#mess_title').html(titles[statusId]);
		if(status[statusId]) {
			$('#mess_content').html(status[statusId].content);
		} else {
			$('#mess_content').html('尚未开始...');
		}
	};
	
	var refreshMyWebsiteById = function() {
		$.post('inter/getMyWebInfoById.php', 'webid=' + curWebsiteId, function(res) {
			res = JSON.parse(res);
			status = res.statuses;
			if(res.debug_domain) {
				$('#debug_domain').html('<a href="' + res.debug_domain + '" target="blank">' + res.debug_domain + '</a>');
			} else {
				$('#debug_domain').html('(申请中......)');
			}
			if(res.debug_domain_password) {
				$('#debug_password').html(res.debug_domain_password);
			}
			if(status && status.length) {
				statusId = status.length - 1;
				refreshStatusById();
				var lis = $('#mystatus_ul').find('li');
				for(var i=0;i<status.length-1;i++) {
					$(lis[i]).addClass('complete');
				}
				$(lis[status.length-1]).addClass('current');
			}
		});
	};
	
	// 更新我的网站
	var myWebs = require('tpl/myWebs');
	var refreshMyWebsites = function() {
		$.post('inter/getMyWebs.php', 'userid='+USERID, function(data) {
			data = JSON.parse(data);
			if(typeof(data)=="object" && data.length!=0) {
				$('.myweb_none').css('display', 'none');
				$('.myweb_content').css('display', 'block');
				var html = Handlebars.compile(myWebs)(data);
				$('#myweb_ul').html(html);
				curWebsiteId = data[data.length-1].id;
				refreshMyWebsiteById();
			}else{
				$('.myweb_none').css('display', 'block');
				$('.myweb_content').css('display', 'none');
			}
		});
	}
	
	refreshMyWebsites();
	
	$(document).on('click', '#myweb_ul > li', function() {
		curWebsiteId = $(this).data('dir');
		refreshMyWebsiteById();
	});
	
	$(document).on('click', '#mystatus_ul > li', function() {
		statusId = $(this).data('dir');
		refreshStatusById();
	});
	
	$('#add_web').on('click', function() {
		$.post('inter/needMoreInfo.php', 'userid='+USERID, function(data) {
			if(data == "true") {
				firstTime();
			} else {
				noneFirst();
			}
		});
	});
	
	var firstTime = function() {
		$('#back').css('display', 'block');
		$('#info_dialog')
		.animate(
			{top : '120px'},
			200,
			'swing'
		)
		.animate(
			{top : '80px'},
			100,
			'swing'
		)
		.animate(
			{top : '100px'},
			100,
			'swing'
		);
	};
	
	var noneFirst = function() {
		$('#back').css('display', 'block');
		$('#demand_dialog')
		.animate(
			{top : '140px'},
			200,
			'swing'
		)
		.animate(
			{top : '100px'},
			100,
			'swing'
		)
		.animate(
			{top : '120px'},
			100,
			'swing'
		);
	}
	
	$('#info_dialog').find('#close_btn').on('click', function(e) {
		e.preventDefault();
		$('#info_dialog')
		.animate(
			{top : '140px'},
			100,
			'swing'
		)
		.animate(
			{top : '-420px'},
			300,
			'swing',
			function(){
				$('#back').css('display', 'none');
			}
		);
	});
	
	$('#info_dialog').find('#submit_info').on('click', function(e) {
		e.preventDefault();
		$.post('inter/submitMoreUserInfo.php', $('#info_form').serialize(), function(data) {
			if(data == "true") {
				$('#info_dialog')
				.animate(
					{top : '140px'},
					100,
					'swing'
				)
				.animate(
					{top : '-420px'},
					300,
					'swing',
					function() {
						$('#demand_dialog')
						.animate(
							{top : '140px'},
							200,
							'swing'
						)
						.animate(
							{top : '100px'},
							100,
							'swing'
						)
						.animate(
							{top : '120px'},
							100,
							'swing'
						);
					}
				);
			} else if (data == "empty") {
				window.alert('请填写全部信息');
			} else {
				window.alert('提交失败，请重试');
			}
		});
	});
	
	$('#demand_dialog').find('#close_btn').on('click', function(e) {
		e.preventDefault();
		$('#demand_dialog')
		.animate(
			{top : '140px'},
			100,
			'swing'
		)
		.animate(
			{top : '-420px'},
			300,
			'swing',
			function(){
				$('#back').css('display', 'none');
			}
		);
	});
	
	$('#demand_dialog').find('#submit_demand').on('click', function(e) {
		e.preventDefault();
		$.post('inter/submitDemand.php', $('#demand_form').serialize(), function(result) {
			if(result == "true") {
				$('#demand_dialog')
				.animate(
					{top : '140px'},
					100,
					'swing'
				)
				.animate(
					{top : '-420px'},
					300,
					'swing',
					function() {
						$('#back').css('display', 'none');
					}
				);
				refreshMyWebsites();
			} else if (result == "empty") {
				window.alert('请填写完整信息');
			} else {
				window.alert('提交失败，请重试');
			}
		});
	});

});
