<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
	
	public function insert($uid,$sid,$sname,$sposter){ 
		
		$this->user_id = $uid;
		$this->series_id = $sid;
		$this->series_name = $sname;
		$this->series_poster = $sposter;
		$this->save(); 
		
	}
	
	public function remove($uid,$sid){
		
		$this->where('user_id','=',$uid)
			 ->where('series_id','=',$sid)
			 ->delete(); 
	
	}
	
	public function isWatching($uid,$sid){
		
		return $this->where('user_id','=',$uid)
					 ->where('series_id','=',$sid)
					 ->count(); 
	
	}
	
	public function get($uid){
		
		return $this->where('user_id','=',$uid)->get();
		
	}
	
	
	
}
