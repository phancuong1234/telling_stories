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
Route::namespace('Web')->group(function () {
	Route::get('login', 'AdminController@showLogin')->name('show_login');
	Route::post('login', 'AdminController@login')->name('action_login');

	Route::group(['prefix' => 'admin','middleware' => 'checklogin'], function () {
		Route::get('/logout', 'AdminController@logout')->name('logout');
		Route::get('', 'AdminController@index')->name('admin.index');
		Route::group(['prefix' => 'user','namespace'=>'user'], function(){
			Route::get('/', 'UserController@index')->name('admin.user.index');

		});

	});
});
