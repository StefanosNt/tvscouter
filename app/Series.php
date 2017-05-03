<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
	public function insert($uid,$sid,$fav){
		$this->user_id = $uid;
		$this->series_id = $sid;
		$this->favorite = $fav;
		$this->save();
	}
}
