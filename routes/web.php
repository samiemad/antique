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

Route::get('/home', 'ItemsController@index');

Route::post('/publish', 'HomeController@postPublish');

Route::get('/publish', 'HomeController@getPublish');

Route::get('/item/{item_id}', 'HomeController@getItem');

Route::post('/item/{item_id}/upload', 'HomeController@postAddImage');

Route::post('/item/{item_id}/comment', 'HomeController@postAddComment');

// Items Controller routes:
Route::post('items/{item}/comment', 'ItemsController@addComment')->name('items.addComment');
Route::delete('items/{item}/comment/{comment}', 'ItemsController@deleteComment')->name('items.deleteComment');
Route::post('items/{item}/image', 'ItemsController@addImage')->name('items.addImage');
Route::delete('items/{item}/image/{image}', 'ItemsController@deleteImage')->name('items.deleteImage');
Route::resource('items', 'ItemsController');

// Like&dislike posts:
Route::post('likeitem', 'ItemsController@like')->name('items.like');

// Users Controller routes:
Route::resource('/admin/users','UserController');

// Categories Controller routes:
Route::get('categories/browse/{category_id?}', 'CategoriesController@browse')->name('categories.browse');
Route::resource('/categories', 'CategoriesController');
Route::get('categories/create/{category_id?}', 'CategoriesController@create')->name('categories.create');

// Locations Controller routes:
Route::get('locations/browse/{location_id?}', 'LocationsController@browse')->name('locations.browse');
Route::resource('/locations', 'LocationsController');
Route::get('locations/create/{location_id?}', 'LocationsController@create')->name('locations.create');

