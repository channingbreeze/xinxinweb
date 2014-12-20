define(function(require, exports, module){

	require('jquery');
	
	var index = 0;
	var total = $('.case_div').find('li').length;
	
	$('#left_button').css('display', 'none');
	if(total == 1) {
		$('#right_button').css('display', 'none');
	}
	
	$('#left_button').on('click', function() {
		index--;
		$('#right_button').css('display', 'block');
		if(index <= 0) {
			$('#left_button').css('display', 'none');
		}
		$('.case_div ul').animate({marginLeft : -800 * index + 'px'});
	});
	
	$('#right_button').on('click', function() {
		index++;
		$('#left_button').css('display', 'block');
		if(index >= total-1) {
			$('#right_button').css('display', 'none');
		}
		$('.case_div ul').animate({marginLeft : -800 * index + 'px'});
	});
	
});
