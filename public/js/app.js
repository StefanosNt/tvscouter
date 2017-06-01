$(document).ready(function() {
	
	var i = 0;
	var oldColor = "red"
	var newColor = "red";
	var textColor = newColor + "-text";
	var accent = "accent-1";
	
	var url =  '/'+ location.href.split('/').slice(3).join('/');  
	
	var username = "info";
	var hostname = "tvscouter.com";
	var linktext = username + "@" + hostname 
	
	//changeTheme(oldColor, newColor);  
	

	$('.parallax').parallax();  
	$(".button-collapse").sideNav(); 
	$('.scrollspy').scrollSpy({ scrollOffset: 60 });  
	$('.modal').modal({
		complete: function() { $("iframe").attr("src", $("iframe").attr("src")); } 
	});
 
//    $('.extras-wrapper').mousewheel(function(e, delta) {
//			this.scrollLeft -= (delta * 40);
//			e.preventDefault();
//		
//			console.log(delta);
//    });
	
	
	$('#contact-email').text(linktext);	
	if(url == '/password/reset')	$("#options").hide();
	
	$('.sidebar-option').each(function(){
		if( $(this).attr('href') == url){
			$(this).addClass('active-item')
				.removeClass('white-text')
				.addClass(textColor); 
			$(this).find('i').removeClass('white-text')
				.addClass(textColor); 
			
		}
	});
	
	$('#expand-toggle').click(function() {
	
		if (i % 2 == 0) {
			//compressed 
			
			$('#expand-toggle').removeClass('expanded').addClass('compressed')
			$('#sidebar').css('width',50);
			$('main').css('padding-left',50);
			$('#user-name').hide();
			$('#user-img').hide();
			$('.sidebar-text').hide();
			i++;
		} 
		else {
			//expanded 
			
			$('#expand-toggle').removeClass('compressed').addClass('expanded')
			$('#sidebar').css('width',158);
			$('main').css('padding-left',158);
			$('#user-name').show();
			$('#user-img').show();
			$('.sidebar-text').show();
			i++;
		}

	});

	$('#search-button').click(function() {

		$('#search-box').slideDown('fast');
		$('#search-box input').fadeIn().addClass('input-show').focus();
		$('#search-results').empty();

	});

	$('#search-box input').on("focusout", function() {

		$('#search-box input').val('').fadeOut().removeClass('input-show');
		$('#search-results').removeClass('search-results-style');
		$('#search-box').fadeOut();

	});

	$(".search-input").keyup(function(e) {

		var inputVal = $('.search-input').val();

		$('#search-results').removeClass('search-results-style');  
		$('#search-results').html('');
		$(".loading").show(); 
		clearTimeout($.data(this, 'timer'));
		console.log(inputVal);
		if ( inputVal == "") {
			$('#search-results').html('');
			$(".loading").hide();
		}
		if (e.keyCode == 13) {
			getData();
		} 
		else if (e.keyCode == 8) {
			if (inputVal == "") {
				$(".loading").hide();
			} 
			else {
				$(".loading").show();
			}
			$('#search-results').html('');
			$(this).data('timer', setTimeout(getData, 500));
		} 
		else {
			$(this).data('timer', setTimeout(getData, 500));
		} 
	});

	function getData() {

		$('#search-results').html('');
		$('#search-results').slideDown("fast");
		$.ajax({
			async: false,
			method: 'GET',
			url: '/tv/search/' + $('.search-input').val().toString(),
			success: function(res) {
				console.log(res);
				if (res.results.length === 0) {
					console.log("No record found");
					$(".loading").hide();
					$('#search-results').addClass('search-results-style').append('<p style="text-align:center"> No record found</p>');
				}
				$.each(res.results, function(i, ser) {
					$(".loading").hide();
					var name = ser.name;
					var id = ser.id;
					var airdate = ser.first_air_date;
					var poster = 'https://image.tmdb.org/t/p/w185' + ser.poster_path;
					if (ser.poster_path === null) poster = "http://placehold.it/185x278?text=NO+POSTER"
					$('#search-results').addClass('search-results-style');
					$('#search-results').append(
						'<div class="card horizontal search-content">' +
							'<div class="card-image">' +
								'<a href="/tv/' + id + '"><img src="' + poster + '"></a>' +
							'</div>' +
							'<div class="card-stacked">' +
								'<div class="card-content">' +
									'<a href="/tv/' + id + '">' +
										'<p>' + name + '</p>' +
										'<p style="color:#8b8b8b">' + airdate + '</p>' +
									'</a>' +
								'</div>' +
							'</div>' +
						'</div>'
					); 
				});
			}
		}) 
	}
	
	function changeTheme(oldColor,newColor){
		
		var colorElements = document.getElementsByClassName(oldColor);
		
		$(colorElements).each(function(){
			$(this).removeClass(oldColor).addClass(newColor);
		}); 
		
	}
});  
  
	
(function(i, s, o, g, r, a, m) {
	i['GoogleAnalyticsObject'] = r;
	i[r] = i[r] || function() {
		(i[r].q = i[r].q || []).push(arguments)
	}, i[r].l = 1 * new Date();
	a = s.createElement(o),
		m = s.getElementsByTagName(o)[0];
	a.async = 1;
	a.src = g;
	m.parentNode.insertBefore(a, m)
})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-99613813-1', 'auto');
ga('send', 'pageview');