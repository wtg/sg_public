jQuery(document).ready(function($) {
	var SCROLL_CUTOFF = 75;

	if($(document).scrollTop() > SCROLL_CUTOFF) {
  		$('.logo').addClass('shrink');
	}

	$(window).scroll(function() {
		if ($(document).scrollTop() > SCROLL_CUTOFF) {
			$('header').addClass('shrink');
		} else {
			$('header').removeClass('shrink');
		}
	});
});
