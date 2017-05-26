
$(document).ready(function() {
	var watching, seasons;
	var i = 0;

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function watchState() {
		$.ajax({
			'_token': $('meta[name=csrf-token]').attr('content'),
			async: false,
			method: 'POST',
			url: '/watchliststate',
			data: {
				"uid": uid,
				"sid": sid
			},
			success: function(data) {
				watching = data;
			}
		});
	}

	function highlight() {
		if (watching == 1) $(".watchlist-btn").addClass("watchlist-btn-true").text("Watching");
		if (watching == 0) $(".watchlist-btn").removeClass("watchlist-btn-true").text("Add to watchlist");
	}

	watchState();
	highlight();

	console.log(watching); 

	$(".watchlist-btn").click(function() { 
		$.ajax({
			'_token': $('meta[name=csrf-token]').attr('content'),
			async: false,
			method: 'POST',
			url: '/tv/'+sid,
			data: {
				"uid": uid,
				"sid": sid,
				"sname": sname,
				"sposter": sposter,
				"totalSeriesMinutes": totalSeriesMinutes
			},
			success: function(s) {
				console.log(s);
			}
		});

		watchState();
		console.log(watching);
		highlight();
		
	});

	$.ajax({
		async: false,
		method: 'GET',
		url: '/tv/'+sid+'/all',
		success: function(s) {
			seasons = s;
		}
	});

	console.log(seasons);

	$(".seasons").click(function(e) {
		$(".seasons .active").removeClass("active");
		$("#" + e.target.id).addClass("active");
		$("#episode-list .episode").remove()
		$.each(seasons['season/' + e.target.id]['episodes'], function(i, v) {
			$("#episode-list").append(
				'<li class="episode">' +
					'<div class="collapsible-header row episode-header">' +
						'<div class="col s3">' + v.episode_number + '</div>' +
						'<div class="col s5">' + v.name + '</div>' +
						'<div class="col s4">' + v.air_date + '</div>' +
					'</div>' +
					'<div class="collapsible-body episode-body"><span>' + v.overview + '</span></div>' +
				'</li>'
			);
		}); 
	}); 
});