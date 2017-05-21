<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	public function getTotalMinutes($uid){
		return DB::table('users')->where('id', $uid)->value('minutes_watched');
	}
	public function addTotalMinutes($totalSeriesMinutes,$uid){ 
		$minutesWatched = DB::table('users')->where('id', $uid)->value('minutes_watched');
		DB::table('users')->where('id', $uid)->update(['minutes_watched' => $minutesWatched + $totalSeriesMinutes]);
	}
	public function subtractTotalMinutes($totalSeriesMinutes,$uid){ 
		$minutesWatched = DB::table('users')->where('id', $uid)->value('minutes_watched');
		DB::table('users')->where('id', $uid)->update(['minutes_watched' => $minutesWatched - $totalSeriesMinutes]);
	}
}
