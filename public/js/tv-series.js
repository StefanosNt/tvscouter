
$(document).ready(function() {
	var seasons;
	var i = 0;

	function watchState() {
		
		$.ajax({
			async: true,
			method: 'POST',
			url: '/watchliststate',
			data: {
				"uid": uid,
				"sid": sid
			},
			success: function(watching) {
				
				if (watching == 1) $(".watchlist-btn").addClass("watchlist-btn-true").text("Watching");
				if (watching == 0) $(".watchlist-btn").removeClass("watchlist-btn-true").text("Add to watchlist");
				
				console.log(watching);
				
			}
			
		}); 
		
	} 

	watchState();  
	
	$(".watchlist-btn").click(function() { 
		$.ajax({
			async: true,
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
				watchState(); 
			}
		});

	
		
	});

	$.ajax({
		async: true,
		method: 'GET',
		url: '/tv/'+sid+'/all',
		success: function(s) {
			seasons = s;
			console.log(seasons);

		}
	});

	
	$(".people").click(function(e){
		
		$.ajax({
			async: true,
			method: 'GET',
			url: '/people/'+ e.target.id,
			beforeSend: function(){ 
				$('#loader').show();
				$('#person-info').hide(); 
			},
			success: function(s) {
				console.log(s);
				$('#loader').hide();
				$('#person-info').show();
				$('#person-img').attr('src','https://image.tmdb.org/t/p/w185/'+s.profile_path);
				$('#imdb-link').attr('href','http://www.imdb.com/name/'+s.imdb_id);
				$('#name').text(s.name);
				$('#birthday').text(s.birthday);
				$('#birthplace').text(s.place_of_birth);
				$('#bio').text(s.biography); 
			}
		});		
		
	});
	
	
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