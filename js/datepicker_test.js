Modernizr.load({
	test: Modernizr.inputtypes.date,
	nope: [
		'/js/vendor/jquery.js',
	 	'/js/vendor/jquery-ui.js',
	 	'/css/ui-lightness/jquery-ui.css',
	 	'/js/datepicker.js'
		]
});