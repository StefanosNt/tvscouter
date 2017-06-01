<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Schedule;

class ScheduleController extends Controller
{
	
	public function __construct(){
		
		$this->middleware('auth');
		
	}
	
	public function showSchedule(){
		
		/*Renders the user schedule */
  		$scheduleTable = new Schedule;
 		$schedule = json_decode($scheduleTable->get(Auth::user()->id),true);
		return view('series.schedule',compact('schedule'));   
		
	}
	
	public function addToSchedule($sid,$curDate){
		
		$seriesController = new SeriesController;
		$series= $seriesController->getAllSeasons($sid); 
		$curSeason = $series['number_of_seasons']; 
		
		if($series['status']!=="Canceled" && $series['status']!=="Ended"){   
			
			foreach ($series['season/'. $curSeason]['episodes'] as $episodes){
								
				if ($curDate <= $episodes['air_date']) {

					$arr = [
						'sid'			=>	$series['id'],
						'sname'			=>	$series['name'], 
						'sposter'		=>	$series['poster_path'],
						'snetwork'		=>	implode(',', array_map(function($el){ return $el['name']; }, $series['networks'])),
						'sgerne'		=>	implode(',', array_map(function($el){ return $el['name']; }, $series['genres'])),
						'season'		=>	$series['number_of_seasons'],
						'epnumber'		=>	$episodes['episode_number'],
						'epname'		=>	$episodes['name'],
						'epoverview'	=>	$episodes['overview'],
						'epairdate'		=>	$episodes['air_date']
					];	
					
					$schedule = new Schedule;
					$schedule->insert(Auth::user()->id,$arr); 
					
				}  
			}
		} 
	} 
}
