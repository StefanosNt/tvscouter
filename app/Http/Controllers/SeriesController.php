<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\Auth; 
use GuzzleHttp\Client; 
use App\Series;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
	public static $baseURL = 'https://api.themoviedb.org/3';
	public static $apiKey = '5356352546e70dce6c10c8c67d5e0604';

	public function index(){

		return view('homepage');
	}
    public function popular() {
		//full url
		//https://api.themoviedb.org/3/tv/popular?api_key=5356352546e70dce6c10c8c67d5e0604&language=en-US&page=1
		$client = new Client();
		$category = '/tv/popular';
		$url = self::$baseURL. $category ;

        $res = $client->request('GET', $url,[
			'verify' => FALSE,
			'form_params' => [
				'page' => '1',
				'language' => 'en-US',
				'api_key' => self::$apiKey
 			]
		]);

		$popular = json_decode($res->getBody(),true);
		$popular = $popular['results'];
//		return $popular[1];
//		return dd($popular);
		return view('series.popular',compact('popular'));

	}
	public function getSeries($id){
		$client = new Client();
		$category = '/tv/'. $id;
		$url = self::$baseURL. $category;
		$series = $client->request('GET', $url,[
			'verify' => FALSE,
			'form_params' => [
				'api_key' => self::$apiKey,
				'language' => 'en-US'
			]
		]);

		$series = json_decode($series->getBody(),true);

//		return dd($series);
//		return view('tv-series',compact('series'));
		return $series;
	}
	public function getSeason($id,$season){


//		https://api.themoviedb.org/3/tv/1402/season/1?api_key=5356352546e70dce6c10c8c67d5e0604&language=en-US&append_to_response=%20
		$client = new Client();
		$category = '/tv/'. $id. '/season/'. $season;
		$url = self::$baseURL. $category;

		$season = $client->request('GET', $url,[
			'verify' => FALSE,
			'form_params' => [
				'api_key' => self::$apiKey,
				'language' => 'en-US'
			]
		]);

		$season=json_decode($season->getBody(),true);
//		return dd($season);
		return $season;

	}
	public function showSeries($id){

		$seasonNumber = 1;
		$series = self::getSeries($id);
		$season = self::getSeason($id,1);
//		return dd($series);
		return view('series.tv-series',compact('series','season','seasonNumber'));

	}
//	public function showSeriesSeason($id,$season){
//
//		$seasonNumber = $season;
//		$series = self::getSeries($id);
//		$season = self::getSeason($id,$season);
//		return view('tv-series',compact('series','season','seasonNumber'));
//	}

	public function getAllSeasons($id){
		$client = new Client();
		$category = '/tv/'. $id;
		$url = self::$baseURL. $category;
		$seasons = "";

		$series = self::getSeries($id);
		$totalSeasons = $series['number_of_seasons'];

		for($i = 1 ; $i <= $totalSeasons ; $i++){
			$seasons = $seasons. "season/$i,";
		}
//		return $seasons;

		$seasons = $client->request('GET', "https://api.themoviedb.org/3/tv/$id?api_key=5356352546e70dce6c10c8c67d5e0604&append_to_response=". $seasons,['verify' => FALSE ]);
		$seasons=json_decode($seasons->getBody(),true);
//		echo dd($serie
		return $seasons;


////		return $totalSeasons;
//		for($i = 1 ; $i <= $totalSeasons ; $i++){
//			$seasons[$i] = self::getSeason($id,$i);
//		}

//		return dd($seasons);


	}

	public function searchTvSeries($seriesTitle){
		//full url
		//https://api.themoviedb.org/3/search/tv?api_key=5356352546e70dce6c10c8c67d5e0604&language=en-US&query=th&page=1
		$client = new Client();
		$category = '/search/tv';
		$url = self::$baseURL. $category;
		$res = $client->request('GET', $url,[
			'verify' => FALSE,
			'form_params' => [
				'api_key' => self::$apiKey,
				'language' => 'en-US',
				'query' => $seriesTitle,
				'page' => '1'
			]
		]);

//		$searchRes = json_encode($res->getBody(),true);
		$searchRes = json_decode($res->getBody(),true);
		return $searchRes;
//		return view('tv-series');

	}
	public function watchlistState (Request $request) { 
		
		$ser = new Series;  
		$watching = $ser->isWatching($request->get('uid'),$request->get('sid'));
		
		return $watching == 1 ? 1 : 0;
		
	} 
	
	public function editWatchlist (Request $request) {
		$ser = new Series; 
		if($ser->isWatching($request->get('uid'),$request->get('sid'))==0){
			$ser->insertIntoWatchlist($request->get('uid') ,$request->get('sid'), $request->get('sname'), $request->get('sposter'));
			$curDate = date('Y-m-d');   
			self::addToSchedule($request->get('sid'),$ser,$curDate);
			return 'added';
		}
		else{
			$ser->deleteFromWatchlist($request->get('uid'),$request->get('sid'));
			$ser->deleteFromSchedule($request->get('uid'),$request->get('sid'));
			return 'deleted';
		} 
		
	}  
	
	public function watchlist(){  
		
		$ser = new Series;  
		$watchlist = json_decode($ser->getWatchlist(Auth::user()->id),true); 
		return view('series.watchlist',compact('watchlist'));
	}

	public function schedule(){
		$ser = new Series;   
 		$schedule = json_decode($ser->getSchedule(Auth::user()->id),true);
		return view('series.schedule',compact('schedule'));   
	}
	public function addToSchedule($sid,$ser,$curDate){
		$series= self::getAllSeasons($sid); 
		$curSeason = $series['number_of_seasons'];
//		return $series;
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
		 
		$curDate = date('Y-m-d',strtotime(date('Y-m-d')));
		$date = date('Y-m-d',strtotime('2017-05-11'));
		
		$epYear = date('Y',strtotime($date));
		$epMonth = date('m',strtotime($date));
		$epDay = date('d',strtotime($date));
		
		$yearDiff = date('Y',strtotime($date)) - date('Y',strtotime($curDate)); //must be >=0
		$monthDiff = date('m',strtotime($date)) - date('m',strtotime($curDate)); // must be >=0
		$dayDiff = date('d',strtotime($date)) - date('d',strtotime($curDate)); 
		
//		if($curDate > $date){
//			echo $date. '<br>'. $curDate; 
//		}
//		return '<br>'. $yearDiff. '<br>'. $monthDiff. '<br>'. $dayDiff ;
		return view('series.test',compact('date','yearDiff','monthDiff','epYear','epMonth','epDay'));
//		return dd(self::getSeries(60735));
	}
	
	public function sss(){
		$ser = new Series;
//		$ser->insertIntoWatchlist(6 ,1, 's','s');
//		return $s = DB::table('_watchlist_uid_6')->where('series_id','=','6')->count();
//				DB::table('_watchlist_uid_'. 6)->where('sid','=',1412)->delete(); 
// 	return dd($ser->getWatchlist(6));
//		$ser->createWatchlistTable( Auth::user()->id );
		$client = new Client();
		$seasons = $client->request('GET', "https://api.themoviedb.org/3/tv/60735?api_key=5356352546e70dce6c10c8c67d5e0604&append_to_response=",['verify' => FALSE ]);
		$seasons=json_decode($seasons->getBody(),true);
		dd($seasons); 
	}
}
