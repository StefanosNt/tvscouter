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

Auth::routes();


Route::get('/popular', 'SeriesController@popular')->middleware('auth');
Route::get('/homepage', 'SeriesController@index')->middleware('auth');


//Route::get('/tv/{seriesTitle}','SeriesController@getTvSeries');
Route::get('/tv/{id}','SeriesController@showSeries');
//Route::get('/tv/{id}/season/{season}','SeriesController@showSeriesSeason');


Route::get('/tv/{id}/season/{season}','SeriesController@getSeason');
Route::get('/tv/{id}/all','SeriesController@getAllSeasons');
Route::get('/tv/search/{title}','SeriesController@searchTvSeries');

Route::get('/signup','UserController@signup');
Route::get('/', 'HomeController@index')->name('landing');
//Route::get('/home', 'HomeController@index');



Route::get('/ss','SeriesController@ss');
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/homepage',function() {
//	$name = "stef";
//	$name = "stef";
//	return view('homepage',compact('name'));
//});
//
//Route::get('layout',function(){
//	return view('layout');
//});




//Route::get('/home', 'HomeController@index');
//Route::get('/', function(){
//	return view('landing-page');
//})->name('landing');
