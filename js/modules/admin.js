define(function(require, exports, module){

	require('jquery');
	require('pagination');
	require('handlebars');
	
	var titles = ['提交需求', '确定样式', '完成功能', '全站测试', '网站上线'];
	var curWebsiteId = 0;
	var statusId = 0;
	var status;
	var curUserid;
	
	var refreshStatusById = function() {
		$('#mess_title').html(titles[statusId]);
		if(status[statusId]) {
			$('#mess_content').html(status[statusId].content.replace(/<br\s*\/?>/g, ""));
		} else {
			$('#mess_content').html('尚未开始...');
		}
	};
	
	var refreshMyWebsiteById = function() {
		$.post('inter/getUserWebInfoById.php', 'webid=' + curWebsiteId, function(res) {
			res = JSON.parse(res);
			status = res.statuses;
			if(res.debug_domain) {
				$('#debug_domain').val(res.debug_domain);
			} else {
				$('#debug_domain').val('申请中......');
			}
			if(res.debug_domain_password) {
				$('#debug_password').val(res.debug_domain_password);
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
	var refreshUserWebsites = function(userid) {
		$.post('inter/getUserWebs.php', {userid : userid}, function(data) {
			data = JSON.parse(data);
			if(typeof(data)=="object" && data.length!=0) {
				$('.myweb_none').css('display', 'none');
				$('.myweb_content').css('display', 'block');
				var html = Handlebars.compile(myWebs)(data);
				$('#myweb_ul').html(html);
				curWebsiteId = data[data.length-1].id;
				refreshMyWebsiteById();
			}else{
				$('#myweb_ul').html('');
				$('.myweb_content').css('display', 'none');
				$('.myweb_none').css('display', 'block');
			}
		});
	}
	
	$(document).on('click', '#myweb_ul > li', function() {
		curWebsiteId = $(this).data('dir');
		refreshMyWebsiteById();
	});
	
	$(document).on('click', '#mystatus_ul > li', function() {
		statusId = $(this).data('dir');
		refreshStatusById();
	});
	
	$('#debug_domain').on('focusout', function(){
		$.post('inter/setDebugDomain.php', {debug_domain : $(this).val(), websiteId : curWebsiteId}, function(data){
			if(data == "true") {
				window.alert("更新成功");
			} else {
				window.alert("更新失败");
			}
		});
	});
	
	$('#debug_password').on('focusout', function(){
		$.post('inter/setDebugPassword.php', {debug_domain_password : $(this).val(), websiteId : curWebsiteId}, function(data){
			if(data == "true") {
				window.alert("更新成功");
			} else {
				window.alert("更新失败");
			}
		});
	});
	
	$('#mess_content').on('focusout', function(){
		var content = $(this).val();
		if(statusId <= status.length - 1) {
			$.post('inter/setStatus.php', {content : content, status_id : status[statusId].id}, function(data){
				if(data == "true") {
					window.alert("更新成功");
				} else {
					window.alert("更新失败");
				}
			});
		} else if(statusId == status.length) {
			$.post('inter/setStatus.php', {content : content, website_id : curWebsiteId, status_id : statusId}, function(data){
				if(data == "true") {
					window.alert("更新成功");
				} else {
					window.alert("更新失败");
				}
			});
		}
	});
	
	var inflateWeb = function(userid) {
		refreshUserWebsites(userid);
	}
	
	var bindUserTable = function() {
		$('#user_table').find('a').on('click', function(e){
			e.preventDefault();
			$this = $(this);
			inflateWeb($this.data('id'));
			curUserid = $this.data('id');
			$('#admin_user').css('display', 'none');
			$('#admin_web').css('display', 'block');
		});
	}
	
	Handlebars.registerHelper("parseGender", function(v, options) {
		if(v == 0)
			v="男";
		else if(v == 1)
			v="女";
		else
			v="";
		return new Handlebars.SafeString(v);
	});
	
	var refreshUserTable = function(curPage) {
		$.post('inter/getUserList.php', curPage?{curPage:curPage}:{}, function(data){
			data = JSON.parse(data);
			$('#user_table').html(Handlebars.compile(userTable)(data.userList));
			bindUserTable();
			var pagination=$.pagination({
				toPage : parseInt(data.curPage),
				totalPage : parseInt(data.totalPage)
			});
			$('#user_pagination').html(pagination);
			bindPagination();
		});
	}
	
	var bindPagination = function() {
		$('#user_pagination').find('a').on('click', function(e){
			e.preventDefault();
			$this = $(this);
			refreshUserTable($this.data('to'));
		});
	}
	
	var userTable = require('tpl/userTable');
	refreshUserTable();
	
	$('#back_button').on('click', function(e){
		$('#admin_user').css('display', 'block');
		$('#admin_web').css('display', 'none');
	});
	
});
