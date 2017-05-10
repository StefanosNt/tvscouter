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
					$series= (new SeriesController)->getAllSeasons($w['series_id']); 
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

								$ser->insertIntoSchedule(Auth::user()->id,$arr); 
							}  
						}
					}    
				} 
			} 
			
			return view('homepage');
			
		}else{
			return view('landing-page');
		}
    } 
}
