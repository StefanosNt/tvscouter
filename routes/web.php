<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//if not logged in hitting '/' will redirect to landing or else to homepage

Auth::routes();

Route::GET('/'										, 	'HomeController@index')->name('landing');
Route::GET('/tv/{id}'								, 	'SeriesController@showSeries');
Route::GET('/tv/{id}/all'							, 	'SeriesController@getAllSeasons');
Route::GET('/tv/{id}/season/{season}'				, 	'SeriesController@getSeason');
Route::GET('/tv/category={category}&page={page}'	, 	'SeriesController@showSection');
Route::GET('/schedule'								, 	'ScheduleController@showSchedule');
Route::GET('/watchlist'								,	'WatchlistController@showWatchlist'); 
Route::GET('/settings'								, 	'UserController@index');
Route::GET('/settings/user_password_reset'			, 	'UserController@getUserPasswordReset');
Route::GET('/people/{pid}'							,	'PeopleController@get');
Route::GET('/watchliststate'						,	'SeriesController@getWatchlistState');

Route::POST('/tv/{id}'								,	'WatchlistController@editWatchlist'); 
Route::POST('/tv/search/'							,	'SearchController@searchSeries');
Route::POST('/watchliststate'						,	'WatchlistController@getWatchlistState');
Route::POST('/settings/update_info'					,	'UserController@updateInfo')->name('update_info');
Route::POST('/settings/user_password_reset'			,	'UserController@passwordReset')->name('user.password_reset');

//TESTING

Route::GET('/ss'									,	'SeriesController@ss');									
Route::GET('/sss'									,	'SeriesController@sss'); 