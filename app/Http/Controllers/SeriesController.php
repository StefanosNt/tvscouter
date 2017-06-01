<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\Auth; 
use GuzzleHttp\Client;  
use App\User;
use App\Watchlist;
use App\Schedule;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
	public static $baseURL = 'https://api.themoviedb.org/3';
	public static $apiKey = '5356352546e70dce6c10c8c67d5e0604';
	
	public function __construct(){
		
		/*	Initialization of controllers and default params	*/
			 
		$this->middleware('auth')->except('ss');
		 
		$this->client 		=	new Client;
		$this->user			= 	new User; 
		$this->watchlist	= 	new Watchlist;
		$this->schedule		= 	new Schedule;
		
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
		
		$url = self::$baseURL. '/tv/'. $id. '?'. self::$apiKey. '&append_to_response=videos,recommendations,credits'; 
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
 
	
	public function getRecommendations($id){
		
		$url = self::$baseURL. '/tv/'. $id. '/recommendations';
		$res = $this->client->request('GET', $url, $this->params);
		return json_decode($res->getBody(),true)['results'];

	}
 
	public function ss(){ 
		
		return $this->schedule->updatedAt(Auth::user()->id);
//		self::addToSchedule(60573,$curDate);
//		$arr = [
//			'sid'			=>	1,
//			'sname'			=>	'stef', 
//			'sposter'		=>	'sdasdasda',
//			'snetwork'		=>	'cw',
//			'sgerne'		=>	'Sci-fi',
//			'season'		=>	3,
//			'epnumber'		=>	24,
//			'epname'		=>	'be a bear',
//			'epoverview'	=>	'nothing is left',
//			'epairdate'		=>	'2011-10-02'
//		];	
//		$this->schedule->insert(Auth::user()->id,$arr);
//		$this->schedule->remove(10);
//		dd(self::getRecommendations(456));
//		return $this->user->subtractTotalMinutes(22,7);
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