$(document).ready(function() {
	$('ul li:nth-child('+(page+1)+')').addClass("active").removeClass("waves-effect");

	if ($("ul li:nth-child(2)").hasClass("active")) {
		$("ul li:nth-child(1)").addClass('disabled').removeClass('waves-effect');
	}

	if ($("ul li:nth-last-child(2)").hasClass("active")) {
		$("ul li:nth-last-child(1)").addClass('disabled').removeClass('waves-effect');
	}

});