define(function(require, exports, module){

	require('jquery');
	
	$('.right_hire_div').find('span').on('click', function() {
		$(this).parent().find('div').slideDown({display : 'block'});
	});
	
	$('.right_hire_div').find('li').on('mouseleave', function() {
		$(this).find('div').slideUp({display : 'none'});
	});
	
});
