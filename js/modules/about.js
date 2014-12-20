define(function(require, exports, module){

	require('jquery');
	
	$('#info1').slideDown().addClass('active');
	
	$('.nav_div').find('li').on('click', function() {
		var downId = '#'+$(this).data('id');
		$('.info.active').removeClass('active').slideUp('normal', function() {
			$(downId).slideDown().addClass('active');
		});
	});
	
});
