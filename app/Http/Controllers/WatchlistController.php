<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Watchlist;
use App\Schedule;
use App\User;

class WatchlistController extends Controller
{
	
	public function __construct(){
		
		$this->middleware('auth');
		
	}
	
	public function getWatchlistState (Request $request) {  
		
		/*	This function is ajaxed from the tv-series view so it determines if a user is watching a tv show or not	*/
		$watchlist = new Watchlist;
		$watching = $watchlist->isWatching($request->get('uid'),$request->get('sid')); 
		
		return $watching == 1 ? 1 : 0;
		
	} 
	
	public function editWatchlist (Request $request) { 
		
		/*If a user adds or delete a tv show from his watchlist it updates the schedule and watchlist table */
		$watchlist 	= new Watchlist;
		$user 		= new User;
		$schedule	= new Schedule;
		$scheduleController = new ScheduleController;
		
		if($watchlist->isWatching($request->get('uid'),$request->get('sid'))==0){
			$watchlist->insert($request->get('uid') ,$request->get('sid'), $request->get('sname'), $request->get('sposter'));
			$curDate = date('Y-m-d');   
			$scheduleController->addToSchedule($request->get('sid'),$curDate);
			$user->addTotalMinutes($request->get('totalSeriesMinutes'),Auth::user()->id);
			return "added";
		}
		
		else{
			$watchlist->remove($request->get('uid'),$request->get('sid'));
			$schedule->removeSeries($request->get('uid'),$request->get('sid'));
			$user->subtractTotalMinutes($request->get('totalSeriesMinutes'),Auth::user()->id);

			return 'deleted';
		} 
		
	}  
	
	public function showWatchlist(){  
		
		/*	Renders the user watchlist 	*/
		$watchlistTable = new Watchlist;

		$watchlist = json_decode($watchlistTable->get(Auth::user()->id),true); 
		return view('series.watchlist',compact('watchlist'));
		
	}
	
}
