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
  	@foreach($schedule  as $k => $v) 
	  <div id="{{$loop->index}}" class="col s12 episode"> 
		<div class="card horizontal">
		  <div class="card-image">
			<img class="series-img" src="{{'https://image.tmdb.org/t/p/w500'.$v['series_poster']}}">
		  </div>
		  <div class="card-stacked">
			<div class="card-content">
		  	  <span class="card-title"> <a href="/tv/{{$v['series_id']}}"> {{$v['series_name']}} </a> </span>
			  <p class='air-date'>{{$v['air_date']}}</p>
			  <p class='ep-details'>Season {{$v['season_number']}} Episode {{$v['episode_number']}} - {{$v['episode_name']}}</p>
			</div>
			<div class="card-action">
			  <a href="#">This is a link</a>
			</div>
		  </div>
		</div>
	  </div>
	@endforeach    
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