<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/publish', 'HomeController@postPublish');

Route::get('/publish', 'HomeController@getPublish');

Route::get('/item/{item_id}', 'HomeController@getItem');

Route::post('/item/{item_id}/upload', 'HomeController@postAddImage');

Route::post('/item/{item_id}/comment', 'HomeController@postAddComment');


// Route::get('/admin/users', 'AdminController@getUsers');

Route::resource('/admin/users','UserController');