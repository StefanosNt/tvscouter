<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;  
use Illuminate\Support\Facades\DB;  
use App\User; 
use App\Watchlist; 
use App\Schedule; 

class HomeController extends Controller
{
 
	
    public function __construct() { 
			  
		
		$this->serController = new SeriesController; 
		$this->scheduleController = new ScheduleController; 
		$this->user = new User;
		$this->watchlist = new Watchlist;
		$this->schedule = new Schedule;
    
	} 
	
    public function index() {
		
		/*		On homepage call check if user specific tables exist. If not create them.
				The tables are of form : _watchlist_uid_{id} , _schedule_uid_{id}			*/
																					
		if(Auth::check()){    
			
			$curDate = date('Y-m-d'); 
			$updated = $this->schedule->updatedAt(Auth::user()->id);
			$watchlist = json_decode($this->watchlist->get(Auth::user()->id),true);
			if(strtotime($updated)-strtotime($curDate)>0){
			
				$this->schedule->removeSchedule(Auth::user()->id); 
				foreach($watchlist as $w){ 
	 				$this->scheduleController->addToSchedule($w['series_id'],$curDate);   
				} 
			}
			  
			$totalHours = floor($this->user->getTotalMinutes(Auth::user()->id)/60); 
			
			$hours = $totalHours;
			$years = floor($hours / (24*7*4*12));
			$hours -= $years * 24 * 7 * 4 * 12;
			$months = floor($hours / (24*7*4));
			$hours -= $months * 24 * 7 * 4;
			$days = floor($hours / 24);
			$hours -= $days * 24;
 			
			$popular = $this->serController->getSection('popular',12);
			$topRated = $this->serController->getSection('top_rated',12); 
			
			return view('homepage',compact('totalHours','years','months','days','hours','popular','topRated'));
			
		}else{
			return view('landing-page');
		}
    } 
}
