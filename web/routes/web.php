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

Route::get('login', 'Auth\LoginController2@index')->name('login');
Route::post('login_action', 'Auth\LoginController2@login')->name('login2');

Route::group(['prefix' => 'admin','namespace' => 'Web','middleware' => 'auth'], function () {
	Route::get('/logout', 'AdminController@logout')->name('logout');
	Route::get('', 'AdminController@index')->name('admin.index');
	Route::group(['prefix' => 'user','namespace'=>'user'], function(){
		Route::get('/', 'UserController@index')->name('admin.user.index');

		// Route::post('/add', 'UserController@store')->name('admin.user.add');

		// Route::get('/edit/{id}', 'UserController@getedit')->name('admin.user.edit');
		// Route::post('/edit/{id}', 'UserController@postedit')->name('admin.user.edit1');

		// Route::get('/delete/{id}', 'UserController@xoa')->name('admin.user.delete');
		// Route::get('/block/{id}', 'UserController@block')->name('admin.user.block');
		// Route::get('/unblock/{id}', 'UserController@unblock')->name('admin.user.unblock');
	});

});