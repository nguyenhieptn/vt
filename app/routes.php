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

//GUESS acess
Route::get('/',"UserController@login");
Route::get('/login','UserController@login');
Route::post('/actionlogin','UserController@doLogin');



//normal user login
Route::group(['before'=>"sentry"],function(){
    Route::get('dashboard',['as'=>'dashboard','uses'=>'dashboard@index']);
    Route::get('/logout','UserController@logout');
});

//member section
Route::group(['before'=>"sentry|inGroup:member"],function(){
    Route::get('docfrom','MemberDocuments@documentFrom');
    Route::get('docto','MemberDocuments@documentTo');
    Route::get('document/{id}','MemberDocuments@show');
});




//admin sections
Route::group(array("before"=>"Sentry|inGroup:admin"), function(){
    Route::resource("units","UnitsController");
    Route::resource("users","UserController");
    Route::resource("documents","DocumentsController");
    Route::get("documents/{id}/deletefile","DocumentsController@removeFiles");

});