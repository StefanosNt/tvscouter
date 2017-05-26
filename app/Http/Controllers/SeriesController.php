<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\Auth; 
use GuzzleHttp\Client; 
use App\Series;
use App\User;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
	public static $baseURL = 'https://api.themoviedb.org/3';
	public static $apiKey = '5356352546e70dce6c10c8c67d5e0604';
	
	public function __construct(){
		
		/*	Initialization of controllers and default params	*/
		
		$this->client 	=	new Client;
		$this->user		= 	new User;
		$this->ser 		= 	new Series;
		
		$this->form_params['page'] 		= 1;
		$this->form_params['api_key'] 	= self::$apiKey;
		$this->form_params['language'] 	= 'en-us';
		
		$this->params['verify'] = FALSE;
		$this->params['form_params'] = $this->form_params; 

	} 		

    public function showSection($category,$page) {
		
		/*	Returns different view depending on category. Category can either be 'popular' or 'top_rated'	*/

		if($page>10) return "No results";  
		
		$url = self::$baseURL.'/tv/'. $category ; 
		 
		$this->form_params['page'] = $page;
		$this->params['form_params'] = $this->form_params; 
 
        $res = $this->client->request('GET', $url, $this->params); 
		
		$section = json_decode($res->getBody(),true);
		$section = $section['results']; 
		
		return view('series.section',compact('section','category'));

	}
	
	public function getSection($category,$items){ 
	
		/*	Returns a certain number of given category elements	 */
		
		$url = self::$baseURL.'/tv/'. $category ; 
		
        $res = $this->client->request('GET', $url, $this->params); 
		
		$section = json_decode($res->getBody(),true)['results'];
		
		for($i=0;$i<$items;$i++){ $top[] = $section[$i]; }
		
		return $top;
		
	}
	
	public function getSeries($id){ 
		
		/*	Returns a series array of given id with an added index of total series runtime	*/
		
		$url = self::$baseURL. '/tv/'. $id;
		
		$series = $this->client->request('GET', $url, $this->params); 
		$series = json_decode($series->getBody(),true); 		 
		$series['total_series_minutes'] = $series['number_of_episodes']*$series['episode_run_time'][0];  
		
		return $series;
		
	}
	
	public function getSeason($id,$season){ 
		
		/*	Returns an array consisting of details and episode list of a given series id	*/
		
		$url = self::$baseURL. '/tv/'. $id. '/season/'. $season ;

		$season = $this->client->request('GET', $url, $this->params); 
		$season=json_decode($season->getBody(),true);
		
 		return $season;

	}
	
	public function showSeries($id){
		
		/*	Renders the tv-series view . By default on load the view shows the details of the furst season.
			Using ajax the getALlSeasons is called if the users decides to see details of another season 	*/
		
		$seasonNumber = 1;
		$series = self::getSeries($id);
		$season = self::getSeason($id,1);
		
 		return view('series.tv-series',compact('series','season','seasonNumber'));

	} 

	public function getAllSeasons($id){ 
		  
		/*	This function is called from inside a view to ajax the results of it	*/
		
		$series = self::getSeries($id);
				
		$seasons = ""; 
		$totalSeasons = $series['number_of_seasons']; 
		
		for($i = 1 ; $i <= $totalSeasons ; $i++){
			$seasons = $seasons. "season/$i,";
		} 
		
		$seasons = $this->client->request('GET', "https://api.themoviedb.org/3/tv/$id?api_key=5356352546e70dce6c10c8c67d5e0604&append_to_response=". $seasons,['verify' => FALSE ]);
		$seasons=json_decode($seasons->getBody(),true); 
		
		return $seasons;  
		
	}

	public function searchSeries($seriesTitle){ 
		
		/*	Returns an array of search results	inputed by the user	*/

		$url = self::$baseURL. '/search/tv';
		
		$this->form_params['query'] = $seriesTitle;
		$this->params['form_params'] = $this->form_params;
		 
		$res = $this->client->request('GET', $url, $this->params);
 
		$searchRes = json_decode($res->getBody(),true);
		
		return $searchRes; 

	}
	
	public function getWatchlistState (Request $request) {  
		
		/*	This function is ajaxed from the tv-series view so it determines if a user is watching a tv show or not	*/
		
		$watching = $this->ser->isWatching($request->get('uid'),$request->get('sid')); 
		
		return $watching == 1 ? 1 : 0;
		
	} 
	
	public function editWatchlist (Request $request) { 
		
		/*If a user adds or delete a tv show from his watchlist it updates the schedule and watchlist table */
		
		if($this->ser->isWatching($request->get('uid'),$request->get('sid'))==0){
			$this->ser->insertIntoWatchlist($request->get('uid') ,$request->get('sid'), $request->get('sname'), $request->get('sposter'));
			$curDate = date('Y-m-d');   
			self::addToSchedule($request->get('sid'),$this->ser,$curDate);
			$this->user->addTotalMinutes($request->get('totalSeriesMinutes'),Auth::user()->id);
			return "added";
		}
		else{
			$this->ser->deleteFromWatchlist($request->get('uid'),$request->get('sid'));
			$this->ser->deleteFromSchedule($request->get('uid'),$request->get('sid'));
			$this->user->subtractTotalMinutes($request->get('totalSeriesMinutes'),Auth::user()->id);

			return 'deleted';
		} 
		
	}  
	
	public function showWatchlist(){  
		
		/*	Renders the user watchlist 	*/
		 
		$watchlist = json_decode($this->ser->getWatchlist(Auth::user()->id),true); 
		return view('series.watchlist',compact('watchlist'));
		
	}

	public function showSchedule(){
		
		/*Renders the user watchlist */
  
 		$schedule = json_decode($this->ser->getSchedule(Auth::user()->id),true);
		return view('series.schedule',compact('schedule'));   
		
	}
	
	public function addToSchedule($sid,$ser,$curDate){
		
		$series= self::getAllSeasons($sid); 
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
	 
	public function ss(){  
		return $this->user->subtractTotalMinutes(22,7);
//		$ser = self::getSeries(46896);
//		return $ser['episode_run_time'][0]; 
		
	}
	
	public function sss(){ 
//		$this->ser->insertIntoWatchlist(6 ,1, 's','s');
//		return $s = DB::table('_watchlist_uid_6')->where('series_id','=','6')->count();
//				DB::table('_watchlist_uid_'. 6)->where('sid','=',1412)->delete(); 
// 	return dd($this->ser->getWatchlist(6));
//		$this->ser->createWatchlistTable( Auth::user()->id ); 
		$seasons = $this->client->request('GET', "https://api.themoviedb.org/3/tv/60735?api_key=5356352546e70dce6c10c8c67d5e0604&append_to_response=",['verify' => FALSE ]);
		$seasons=json_decode($seasons->getBody(),true);
		dd($seasons); 
	}
}