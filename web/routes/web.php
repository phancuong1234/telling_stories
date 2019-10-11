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
		Route::group(['prefix' => 'user','middleware' => 'checkadmin'], function(){
			Route::get('/', 'UserController@index')->name('user.index');
			Route::get('/create', 'UserController@create')->name('user.create');
			Route::post('/create', 'UserController@store')->name('user.store');
			Route::post('/create_avatar', 'UserController@update_avatar')->name('avatar.update');
			Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
			Route::post('/edit/{id}', 'UserController@update')->name('user.update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy');
		});
		Route::group(['prefix' => 'category'], function(){
			Route::get('/', 'CategoryController@index')->name('category.index');
			Route::get('/add', 'CategoryController@showAdd')->name('category.showAdd');
			Route::post('/add', 'CategoryController@add')->name('category.add');
			Route::get('/edit/{id}', 'CategoryController@showEdit')->name('category.showEdit');
			Route::post('/edit/{id}', 'CategoryController@edit')->name('category.edit');
			Route::delete('/delete/{id}', 'CategoryController@delete')->name('category.delete');
		});
		Route::group(['prefix' => 'story'], function(){
			Route::get('/', 'StoryController@index')->name('story.index');

		});
	});
});
