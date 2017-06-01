<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;  

class SearchController extends Controller
{
		
	public function __construct(){
		
		$this->middleware('auth');
		
	}
	
	public static $baseURL = 'https://api.themoviedb.org/3';
	public static $apiKey = '5356352546e70dce6c10c8c67d5e0604';
	
	public function searchSeries(Request $request){ 
		
		/*	Returns an array of search results	inputed by the user	*/

		$client = new Client;
		$url 	= self::$baseURL. '/search/tv'; 
		 
        $results = $client->request('GET', $url, [
			
			'verify' 		=>	FALSE,
			'form_params' 	=>	
			
				[ 
					'api_key' 	=> self::$apiKey,
					'query'		=> $request->searchPhrase
				]
			
		]);
		
		return json_decode($results->getBody(),true); 

	}
	
}
