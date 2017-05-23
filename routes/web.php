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
Route::GET('/tv/category={category}&page={page}', 'SeriesController@getSection')->middleware('auth');
Route::GET('/tv/schedule', 'SeriesController@schedule')->middleware('auth');
Route::GET('/tv/watchlist', 'SeriesController@watchlist')->middleware('auth');
Route::GET('/settings', 'UserController@settings')->middleware('auth');

Route::GET('/tv/{id}','SeriesController@showSeries');
Route::GET('/tv/{id}/season/{season}','SeriesController@getSeason');
Route::GET('/tv/{id}/all','SeriesController@getAllSeasons');
Route::GET('/tv/search/{title}','SeriesController@searchTvSeries');


Route::POST('/tv/{id}','SeriesController@editWatchlist'); 
Route::POST('/watchliststate','SeriesController@watchlistState');
Route::GET('/watchliststate','SeriesController@watchlistState');
//Route::DELETE('/tv/{id}','SeriesController@removeFromWatchlist'); 

Route::GET('/usertables','SeriesController@checkWatchlistTableState');
ROute::GET('/{category}/top5','SeriesController@getTop5');

//TESTING

Route::GET('/ss','SeriesController@ss');
Route::GET('/sss','SeriesController@sss');
//Route::GET('/sss/{id}/{sid}/{sname}/{sposter}','SeriesController@sss');

//Route::get('/tv/{seriesTitle}','SeriesController@getTvSeries');
//Route::get('/tv/{id}/season/{season}','SeriesController@showSeriesSeason');
