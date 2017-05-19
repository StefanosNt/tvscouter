<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;  
use Illuminate\Support\Facades\DB; 
use App\Series; 

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
			if(!Schema::hasTable('_watchlist_uid_'. Auth::user()->id) ){ 
				$ser->createWatchlistTable( Auth::user()->id ); 
			} 			
			if(!Schema::hasTable('_schedule_uid_'. Auth::user()->id) ){ 
				$ser->createScheduleTable( Auth::user()->id ); 
			}  
			
			$curDate = date('Y-m-d'); 
			$updated = $ser->getScheduleUpdateDate(Auth::user()->id);
			if(strtotime($updated)-strtotime($curDate)>0){
			
				$ser->emptySchedule(Auth::user()->id);
				$watchlist = json_decode(DB::table('_watchlist_uid_'.Auth::user()->id)->get(),true);
				
				foreach($watchlist as $w){ 
	 				(new SeriesController)->addToSchedule($w['series_id'],$ser,$curDate);   
				} 
			} 
			
			return view('homepage');
			
		}else{
			return view('landing-page');
		}
    } 
}
