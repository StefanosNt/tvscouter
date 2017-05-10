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
			$table->integer('series_id');		 
            $table->string('series_name');
            $table->text('series_poster');	 
			$table->string('series_network');	 
			$table->string('series_genre');		 
			$table->integer('season_number');		 
			$table->integer('episode_number');	 
			$table->string('episode_name');		 
			$table->text('episode_overview');	 
			$table->date('air_date');			 
			$table->date('updated');		 
			
			
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
	
	public function insertIntoSchedule($uid,$arr){
		DB::table('_schedule_uid_'. $uid)->insert(
			[
				'series_id' 		=> $arr['sid'], 
				'series_name' 		=> $arr['sname'],
				'series_poster' 	=> $arr['sposter'],
				'series_network'	=> $arr['snetwork'],
				'series_genre'		=> $arr['sgerne'],
				'season_number'		=> $arr['season'],
				'episode_number'	=> $arr['epnumber'],
				'episode_name'		=> $arr['epname'],
				'episode_overview'	=> $arr['epoverview'],
				'air_date'			=> $arr['epairdate'],
				'updated'			=> date('Y-m-d') 
			]
		);
	}	
	
	public function emptySchedule($uid){
		$updateDate = DB::table('_schedule_uid_'. $uid)->truncate();
	}	
	
	public function getSchedule($uid){
		$schedule = DB::table('_schedule_uid_'. $uid )->get();
		return $schedule;
	}		
	
	public function getScheduleUpdateDate($uid){
		$updateDate = DB::table('_schedule_uid_'. $uid)->select('updated')->first();
		return $updateDate->updated;
	}		
	
	
	
	
	
	
	
	
}
