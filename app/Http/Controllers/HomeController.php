<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;  
use Illuminate\Support\Facades\DB; 
use App\Series; 
use App\User; 

class HomeController extends Controller
{
 
    public function __construct() {
		
		$this->serController = new SeriesController;
		$this->ser = new Series;
		$this->user = new User;
    
	} 
	
    public function index() {
		
		/*		On homepage call check if user specific tables exist. If not create them.
				The tables are of form : _watchlist_uid_{id} , _schedule_uid_{id}			*/
																					
		if(Auth::check()){    
			
			if(!Schema::hasTable('_watchlist_uid_'. Auth::user()->id) ){ 
				$this->ser->createWatchlistTable( Auth::user()->id ); 
			} 			
			if(!Schema::hasTable('_schedule_uid_'. Auth::user()->id) ){ 
				$this->ser->createScheduleTable( Auth::user()->id ); 
			}   
			
			$curDate = date('Y-m-d'); 
			$updated = $this->ser->getScheduleUpdateDate(Auth::user()->id);
			$watchlist = json_decode(DB::table('_watchlist_uid_'.Auth::user()->id)->get(),true);
			if(strtotime($updated)-strtotime($curDate)>0){
			
				$this->ser->emptySchedule(Auth::user()->id); 
				foreach($watchlist as $w){ 
	 				$this->serController->addToSchedule($w['series_id'],$this->ser,$curDate);   
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
 			
			$popular = $this->serController->getSection('popular',10);
			$topRated = $this->serController->getSection('top_rated',10); 
			
			return view('homepage',compact('totalHours','years','months','days','hours','popular','topRated'));
			
		}else{
			return view('landing-page');
		}
    } 
}
