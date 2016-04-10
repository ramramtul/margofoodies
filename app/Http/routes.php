<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/','HomeController@home');
	Route::post('home', 'UserController@create');
	Route::get('home','HomeController@home');

	Route::post('dologin','UserController@dologin');
	Route::get('logout','UserController@logout');

	Route::post('findFood','MenuController@findFood');

	Route::get('restoran/{id}','RestoranController@show');
	Route::get('menus/{id}','MenuController@showList');

});
