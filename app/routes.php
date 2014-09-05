<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/',"UserController@login");
Route::get('/login','UserController@login');
Route::post('/actionlogin','UserController@doLogin');


Route::group(['before'=>"sentry"],function(){
    Route::get('dashboard',['as'=>'dashboard','uses'=>'dashboard@index']);
    Route::get('/logout','UserController@logout');
});



Route::group(array("before"=>"Sentry|inGroup:Admin"), function(){
    Route::resource("units","UnitsController");
    Route::resource("users","UserController");

});