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
Route::GET('/tv/popular', 'SeriesController@popular')->middleware('auth');
Route::GET('/tv/watchlist', 'SeriesController@watchlist')->middleware('auth');

Route::GET('/tv/{id}','SeriesController@showSeries');
Route::GET('/tv/{id}/season/{season}','SeriesController@getSeason');
Route::GET('/tv/{id}/all','SeriesController@getAllSeasons');
Route::GET('/tv/search/{title}','SeriesController@searchTvSeries');


Route::POST('/tv/{id}','SeriesController@addWatchlist');
Route::DELETE('/tv/{id}','SeriesController@removeWatchlist');
Route::PATCH('/tv/{id}','SeriesController@favorite');
Route::PATCH('/tv/{id}','SeriesController@removeFavorite');



//TESTING

Route::GET('/ss','SeriesController@ss');

//Route::get('/tv/{seriesTitle}','SeriesController@getTvSeries');
//Route::get('/tv/{id}/season/{season}','SeriesController@showSeriesSeason');
