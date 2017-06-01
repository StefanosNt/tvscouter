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

Route::GET('/', 'HomeController@index')->name('landing');
Route::GET('/tv/category={category}&page={page}', 'SeriesController@showSection')->middleware('auth');
Route::GET('/tv/schedule', 'SeriesController@showSchedule')->middleware('auth');
Route::GET('/tv/watchlist', 'SeriesController@showWatchlist')->middleware('auth');
Route::GET('/settings', 'UserController@index')->middleware('auth');
Route::GET('/settings/user_password_reset', 'UserController@getUserPasswordReset')->middleware('auth');




Route::GET('/tv/{id}','SeriesController@showSeries');
Route::GET('/tv/{id}/season/{season}','SeriesController@getSeason');
Route::GET('/tv/{id}/all','SeriesController@getAllSeasons');
Route::GET('/tv/search/{title}','SeriesController@searchSeries');


Route::POST('/tv/{id}','SeriesController@editWatchlist'); 
Route::POST('/watchliststate','SeriesController@getWatchlistState');
Route::POST('/settings/update_info','UserController@updateInfo')->name('update_info');
Route::POST('/settings/user_password_reset', 'UserController@passwordReset')->name('user.password_reset')->middleware('auth');


Route::GET('/watchliststate','SeriesController@getWatchlistState');
//Route::DELETE('/tv/{id}','SeriesController@removeFromWatchlist'); 

Route::GET('/usertables','SeriesController@checkWatchlistTableState'); 

//TESTING

Route::GET('/ss','SeriesController@ss');
Route::GET('/sss','SeriesController@sss');
//Route::GET('/sss/{id}/{sid}/{sname}/{sposter}','SeriesController@sss');

//Route::get('/tv/{seriesTitle}','SeriesController@getTvSeries');
//Route::get('/tv/{id}/season/{season}','SeriesController@showSeriesSeason');
