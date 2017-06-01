<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	
	public function insert($uid,$arr){ 
		
		$this->user_id = $uid;
		$this->series_id = $arr['sid'];
		$this->series_name = $arr['sname'];
		$this->series_poster = $arr['sposter'];
		$this->series_network = $arr['snetwork'];
		$this->series_genre = $arr['sgerne'];
		$this->season_number = $arr['season'];
		$this->episode_number = $arr['epnumber'];
		$this->episode_name = $arr['epname'];
		$this->episode_overview = $arr['epoverview'];
		$this->air_date = $arr['epairdate'];
		$this->updated = date('Y-m-d');
		$this->save(); 
		
	}
	
	public function get($uid){
		
		return $this->where('user_id','=',$uid)
			  		->get();
		
	}
	
	public function removeSchedule($uid){
		
		$this->where('user_id','=',$uid)
			 ->delete();
		
	}
	
	public function removeSeries($uid,$sid){
		
		$this->where('user_id','=',$uid)
			 ->where('series_id','=',$sid)
			 ->delete();
		
	} 
	
	public function updatedAt($uid){
		
		if($this->where('user_id','=',$uid)->select('updated')->first()){

			return $this->where('user_id','=',$uid) 
						->first()
						->updated; 
		}
		
	}
	
	
}
