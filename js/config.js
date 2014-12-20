(function(){

	var XINXINWEB = 'http://localhost/xinxinweb';

	seajs.config({
	
		base: XINXINWEB + '/js',
		alias: {
			'jquery': 'lib/jquery.min.js',
			'handlebars': 'lib/handlebars.js',
			'pagination': 'lib/pagination.js'
		}
	
	});
	
}());
