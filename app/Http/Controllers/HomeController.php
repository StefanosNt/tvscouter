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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//		On homepage call check if user specific tables exist. If not create them.
//		The tables are of form : _watchlist_uid_{id} , _schedule_uid_{id}
		
		if(Auth::check()){   
			$ser = new Series;
			$user = new User;
			if(!Schema::hasTable('_watchlist_uid_'. Auth::user()->id) ){ 
				$ser->createWatchlistTable( Auth::user()->id ); 
			} 			
			if(!Schema::hasTable('_schedule_uid_'. Auth::user()->id) ){ 
				$ser->createScheduleTable( Auth::user()->id ); 
			}   
			
			$curDate = date('Y-m-d'); 
			$updated = $ser->getScheduleUpdateDate(Auth::user()->id);
			$watchlist = json_decode(DB::table('_watchlist_uid_'.Auth::user()->id)->get(),true);
			if(strtotime($updated)-strtotime($curDate)>0){
			
				$ser->emptySchedule(Auth::user()->id); 
				foreach($watchlist as $w){ 
	 				(new SeriesController)->addToSchedule($w['series_id'],$ser,$curDate);   
				} 
			}
			
			foreach($watchlist as $w){ 
//				(new SeriesController)->addToSchedule($w['series_id'],$ser,$curDate);   
			} 
			$totalHours = floor($user->getTotalMinutes(Auth::user()->id)/60); 
			$hours = $totalHours;
			
			$years = floor($hours / (24*7*4*12));
			$hours -= $years * 24 * 7 * 4 * 12;
			$months = floor($hours / (24*7*4));
			$hours -= $months * 24 * 7 * 4;
			$days = floor($hours / 24);
			$hours -= $days * 24;
 
			return view('homepage',compact('totalHours','years','months','days','hours'));
			
		}else{
			return view('landing-page');
		}
    } 
}
