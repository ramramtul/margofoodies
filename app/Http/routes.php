<?php
use App\Pesanan;
use App\FasilitasRestoran;
use App\Menu;
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
	Route::post('/','HomeController@home');
	Route::post('home', 'UserController@create');
	Route::get('home','HomeController@home');

	Route::post('dologin','UserController@dologin');
	Route::get('logout','UserController@logout');


	Route::get('profile','UserController@profile');
	Route::get('editProfile', function() {
		return View::make('edit-profile');
	});
	Route::post('editProfile','UserController@confirmEdit');
	// @author rama
	// sistem akan melakukan check in.
	Route::post('view-restoran', 'UserController@visit');

	Route::get('editRestoran', 'RestoranController@edit');
	Route::post('uploadPhotoResto', 'RestoranController@fotoResto');
	Route::get('editMenuRestoran', 'RestoranController@editMenu');
	
	Route::get('profileRestoran', 'RestoranController@view');
	Route::post('editRestoran','RestoranController@confirmEdit');
	Route::get('editWaktuOperasional','WaktuOperasionalController@editWaktu');
	Route::post('editWaktuOperasional','WaktuOperasionalController@confirmEditWaktu');
	Route::get('editFasilitasRestoran','FasilitasRestoranController@editFasilitas');
	Route::post('editFasilitasRestoran','FasilitasRestoranController@addFasilitas');
	Route::delete('editFasilitasRestoran/{id}/{nama}', function ($id, $nama) {
    	FasilitasRestoran::where('id_restoran', '=', $id)->where('nama_fasilitas', '=', $nama)->delete();
    	return redirect('/editFasilitasRestoran');
	});
	Route::get('viewMenu/{id}','MenuController@viewMenu');
	Route::get('editMenu/{id}','MenuController@editMenu');
	Route::post('viewMenu/{id}','MenuController@viewMenu');
	Route::post('searchMenu','MenuController@searchMenu');
	Route::get('searchMenu','MenuController@searchMenu');
	Route::post('editMenu/{id}', 'MenuController@confirmEditMenu');
	Route::post('editMenuHelper/{id}','MenuController@editMenuHelper');
	Route::post('uploadPhotoMenu/{id}', 'MenuController@fotoMenu');
	Route::get('addMenu','MenuController@addMenu');
	Route::post('addMenu','MenuController@confirmAddMenu');
	Route::delete('deleteMenu/{id}/{page}', function ($id, $page) {
    	Menu::find($id)->delete();
    	return redirect('/editMenuRestoran?page='.$page.'');
	});


	Route::post('findFood','MenuController@findFood');

	Route::post('calculateFood','HomeController@calculateFood');
	Route::post('calculate','PesananController@reset');
	Route::post('calculate/{orang}','PesananController@calculateId');
	Route::get('calculateFood/{orang}', 'PesananController@pesan');
	Route::post('calculateFood/{orang}','PesananController@create');
	Route::delete('calculateFood/{orang}', 'PesananController@destroy');
	
	Route::get('restoran','RestoranController@showList');
	Route::get('restoran/{id}','RestoranController@show');
	

	Route::get('menus/{id}','MenuController@showList');
	Route::post('search','MenuController@search');

	Route::get('review/{id}','ReviewController@show');
	Route::post('createReview/{id}','ReviewController@create');

	Route::get('promo','PromoController@showAll');
	Route::get('promo/{id}','PromoController@show');
});

