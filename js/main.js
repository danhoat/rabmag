var RAB = {};

(function($){
	var processScroll = true;
	$(window).scroll(function() {
	    if (processScroll  && $(window).scrollTop() > $(document).height() - $(window).height() - 100) {
	        processScroll = false;
	        // your functionality here
	        console.log('123');
	        processScroll = true;
	    }
	});

})(jQuery)