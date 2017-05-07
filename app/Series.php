<?php

namespace App;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Series extends Model
{
    //
	public function insert($uid,$sid,$watching){ 
		
		$this->user_id = $uid;
		$this->series_id = $sid;
		$this->watching = $watching;
		$this->save();
		
	}
	
	public function createWatchlistTable($uid){
		
		Schema::create('_watchlist_uid_'. $uid, function(Blueprint $table){
			$table->increments('id');
			$table->integer('series_id');
            $table->string('series_name');
            $table->text('series_poster');
            $table->timestamps(); 
		});
	
	}
	public function createScheduleTable($uid){
		
		Schema::create('_schedule_uid_'. $uid, function(Blueprint $table){
			$table->increments('id');
		});
	
	}
	
	public function insertIntoWatchlist($uid,$sid,$sname,$sposter){
		DB::table('_watchlist_uid_'. $uid)->insert(
			[
				'series_id' => $sid , 
				'series_name' => $sname,
				'series_poster' => $sposter
			]
		);
	}	
	
	public function deleteFromWatchlist($uid,$sid){
		DB::table('_watchlist_uid_'. $uid)->where('series_id','=',$sid)->delete(); 
	}
	
	public function isWatching($uid,$sid){
		return DB::table('_watchlist_uid_'. $uid )->where('series_id', '=', $sid)->count();
	}
	
	public function getWatchlist($uid){
		$watchlist = DB::table('_watchlist_uid_'. $uid )->get();
		return $watchlist;
	}
	
	
}
