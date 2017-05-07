@extends('layouts.app')

 
			 
@section('content')
<style>
	#later{ 
	} 
	.schedule-header{
		font-size:2rem;
		font-weight:300; 
	}
</style>

<div class="container">  
	<div id="monday" class="row day-of-week"></div>
	<div id="tuesday" class="row day-of-week"></div>
	<div id="wednesday" class="row day-of-week"></div>
	<div id="thursday" class="row day-of-week"></div>
	<div id="friday" class="row day-of-week"></div>
	<div id="saturday" class="row day-of-week"></div>
	<div id="sunday" class="row day-of-week"></div> 
	<div id="later" class="row"></div>  
	
	<div class="row">
  	 
	  <div id="0" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/2KJBFE4GFfhADNtAH2yv6jSLTky.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1277999"> Once Upon a Time </a> </span>
			  <p class="air-date">2017-05-07</p>
			  <p class="ep-details">Season 6 Episode 20 - The Song in Your Heart</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="1" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/2KJBFE4GFfhADNtAH2yv6jSLTky.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1288245"> Once Upon a Time </a> </span>
			  <p class="air-date">2017-05-14</p>
			  <p class="ep-details">Season 6 Episode 21 - The Final Battle</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="2" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/2KJBFE4GFfhADNtAH2yv6jSLTky.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1304035"> Once Upon a Time </a> </span>
			  <p class="air-date">2017-05-14</p>
			  <p class="ep-details">Season 6 Episode 22 - The Final Battle Part 2</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="3" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/iSXNhNnFicWIMm1JLdkhsjKkKnY.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1305014"> The Last Man on Earth </a> </span>
			  <p class="air-date">2017-05-07</p>
			  <p class="ep-details">Season 3 Episode 17 - When The Going Gets Tough</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="4" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/iSXNhNnFicWIMm1JLdkhsjKkKnY.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1305015"> The Last Man on Earth </a> </span>
			  <p class="air-date">2017-05-07</p>
			  <p class="ep-details">Season 3 Episode 18 - Nature's Horchata</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="5" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/3iFm6Kz7iYoFaEcj4fLyZHAmTQA.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303299"> Supernatural </a> </span>
			  <p class="air-date">2017-05-11</p>
			  <p class="ep-details">Season 12 Episode 21 - There's Something About Mary</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="6" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/3iFm6Kz7iYoFaEcj4fLyZHAmTQA.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303300"> Supernatural </a> </span>
			  <p class="air-date">2017-05-18</p>
			  <p class="ep-details">Season 12 Episode 22 - Who We Are</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="7" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/3iFm6Kz7iYoFaEcj4fLyZHAmTQA.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303301"> Supernatural </a> </span>
			  <p class="air-date">2017-05-18</p>
			  <p class="ep-details">Season 12 Episode 23 - All Along the Watchtower</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="8" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/dDkTZMJHauC4IeO5YyLS7zuIPaP.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303527"> The Originals </a> </span>
			  <p class="air-date">2017-05-12</p>
			  <p class="ep-details">Season 4 Episode 9 - Episode 9</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="9" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/dDkTZMJHauC4IeO5YyLS7zuIPaP.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303529"> The Originals </a> </span>
			  <p class="air-date">2017-05-19</p>
			  <p class="ep-details">Season 4 Episode 10 - Phantomesque</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="10" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/dDkTZMJHauC4IeO5YyLS7zuIPaP.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303530"> The Originals </a> </span>
			  <p class="air-date">2017-05-26</p>
			  <p class="ep-details">Season 4 Episode 11 - Episode 11</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="11" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/dDkTZMJHauC4IeO5YyLS7zuIPaP.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1303531"> The Originals </a> </span>
			  <p class="air-date">2017-06-02</p>
			  <p class="ep-details">Season 4 Episode 12 - Episode 12</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="12" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/lUFK7ElGCk9kVEryDJHICeNdmd1.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1307855"> The Flash </a> </span>
			  <p class="air-date">2017-05-09</p>
			  <p class="ep-details">Season 3 Episode 21 - Cause and Effect</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="13" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/lUFK7ElGCk9kVEryDJHICeNdmd1.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1308206"> The Flash </a> </span>
			  <p class="air-date">2017-05-16</p>
			  <p class="ep-details">Season 3 Episode 22 - Infantino Street</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="14" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/lUFK7ElGCk9kVEryDJHICeNdmd1.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1308207"> The Flash </a> </span>
			  <p class="air-date">2017-05-23</p>
			  <p class="ep-details">Season 3 Episode 23 - Finish Line</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="15" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/mo0FP1GxOFZT4UDde7RFDz5APXF.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1293514"> Arrow </a> </span>
			  <p class="air-date">2017-05-10</p>
			  <p class="ep-details">Season 5 Episode 21 - Honor Thy Fathers</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="16" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/mo0FP1GxOFZT4UDde7RFDz5APXF.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1293515"> Arrow </a> </span>
			  <p class="air-date">2017-05-18</p>
			  <p class="ep-details">Season 5 Episode 22 - Missing </p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	 
	  <div id="17" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="https://image.tmdb.org/t/p/w500/mo0FP1GxOFZT4UDde7RFDz5APXF.jpg">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/1295788"> Arrow </a> </span>
			  <p class="air-date">2017-05-25</p>
			  <p class="ep-details">Season 5 Episode 23 - Episode 23</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	    
	</div>
</div> 

@endsection 

@section('js')
<script>
	$(document).ready(function(){
		var curDate = new Date();   
		var daysVal = []; 
		daysVal['monday'] = 0;
		daysVal['tuesday'] = 1;
		daysVal['wednesday'] = 2;
		daysVal['thursday'] = 3;
		daysVal['friday'] = 4;
		daysVal['saturday'] = 5;  
		daysVal['sunday'] = 6; 
		 
		
		$('.episode').each(function(index,element){
			
			
			var epDate = new Date($('#'+element.id+' .air-date').text()); 
			var yearDiff = epDate.getFullYear() - curDate.getFullYear();
			var monthDiff = epDate.getMonth() - curDate.getMonth();
			var dayDiff = epDate.getDate() - curDate.getDate();
			
			if (yearDiff === 0 && monthDiff === 0 && dayDiff <7 && dayDiff >=0){
				
				$('#'+element.id).appendTo('#'+dayToString(epDate));
//				console.log(epDate + '  ' + dayDiff + '  ' + dayToString(epDate));
			}else{
				$('#'+element.id).appendTo('#later');
			}
			
			
			
		});
		
		var curDayVal = daysVal[dayToString(curDate)];  
		
		$('.day-of-week').each(function(index,element){ 
			var weekDayVal = daysVal[element.id];
			 
			if(!$('#'+element.id).is(':empty')){
				$('#'+element.id).prepend('<span class="schedule-header">'+element.id.charAt(0).toUpperCase()+element.id.slice(1)+'</span>');
			} 
			if(weekDayVal >= curDayVal && curDayVal >0){ 
				$('#'+element.id).insertBefore('#monday');
			} 
		}); 
		
		if(!$('#later').is(':empty')){
			$('#later').prepend('<span class="schedule-header">Later on</span>');
		}		  
		getSortedDates('#later .episode').appendTo('#later'); 
		
		
		function dayToString(d) {
			var days = [];  
			days['Mon'] = 'monday';
			days['Tue'] = 'tuesday';
			days['Wed'] = 'wednesday';
			days['Thu'] = 'thursday';
			days['Fri'] = 'friday';
			days['Sat'] = 'saturday'; 
			days['Sun'] = 'sunday'; 
			return days[d.toString().split(' ')[0]]; // gives long name; 

		}

		function getSortedDates(selector) {
			return $($(selector).toArray().sort(function(a, b){
				var aVal = new Date(a.childNodes[1].childNodes[3].childNodes[1].childNodes[3].innerText),
					bVal = new Date(b.childNodes[1].childNodes[3].childNodes[1].childNodes[3].innerText);
				return aVal - bVal;
			}));
		}
		
	});  
	

	
</script>
@endsection
