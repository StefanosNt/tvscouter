<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;  

class PeopleController extends Controller
{
	public static $baseURL = 'https://api.themoviedb.org/3';
	public static $apiKey = '5356352546e70dce6c10c8c67d5e0604';
		
	public function __construct(){
		
		$this->middleware('auth');
		
	}
	
	public function index(){
		
	}
	
	public function get($pid){

		$client = new Client;
		$url 	= self::$baseURL.'/person/'. $pid; 
		 
        $person = $client->request('GET', $url. '?api_key='. self::$apiKey, ['verify'=> FALSE, ]);
		
		return json_decode($person->getBody(),true);
		
	}
}
