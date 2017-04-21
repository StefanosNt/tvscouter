<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Series;

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
	public function addToFavorites (Request $request) {
		$seriesTable = new Series;
		$seriesTable->insert($request->get('uid') ,$request->get('sid'), $request->get('fav'));
		return $seriesTable::all();

	}

	public function showFavorites() {

	}
}
