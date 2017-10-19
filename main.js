jQuery(document).ready(function($) {
	var SCROLL_CUTOFF = 40;

	if($(document).scrollTop() > SCROLL_CUTOFF) {
  		$('nav').addClass('shrink');
	}

	$(window).scroll(function() {
		if ($(document).scrollTop() > SCROLL_CUTOFF) {
			$('nav').addClass('shrink');
		} else {
			$('nav').removeClass('shrink');
		}
	});

	$('#expand').click(function () {
		$('.right-nav').toggleClass('expanded');
		$('#expand').toggleClass('expanded');
	});

	$('.dropdown-toggle').hover(function () {
		$(this).addClass('show-dropdown');
	}, function () {
		$(this).removeClass('show-dropdown');
	});
});
