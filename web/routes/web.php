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
		Route::get('/profile', 'AdminController@profile')->name('profile');
		Route::get('/profile/edit', 'AdminController@showEditProfile')->name('profile.edit');
		Route::post('/profile/update', 'AdminController@editProfile')->name('profile.update');
		Route::get('', 'AdminController@index')->name('admin.index');
		Route::get('/chart/{id}/{type}', 'AdminController@getDataChart')->name('admin.chart');
		////////user/////
		Route::group(['prefix' => 'user','middleware' => 'checkadmin'], function(){
			Route::get('/', 'UserController@index')->name('user.index');
			Route::post('/change_state/{id}', 'UserController@changeState')->name('user.state');
			Route::get('/create', 'UserController@create')->name('user.create');
			Route::post('/avatar', 'UserController@upAvatar')->name('user.avatar');
			Route::post('/create', 'UserController@store')->name('user.store');
			Route::get('/valid_data', 'UserController@validateData')->name('valid.form');
			Route::get('/valid_data_edit', 'UserController@validateDataEdit')->name('valid.formEdit');
			Route::get('/detail/{id}', 'UserController@detail')->name('user.detail');
			Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
			Route::post('/edit/{id}', 'UserController@update')->name('user.update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy');
		});
		/////////category/////
		Route::group(['prefix' => 'category'], function(){
			Route::get('/', 'CategoryController@index')->name('category.index');
			Route::get('/add', 'CategoryController@showAdd')->name('category.showAdd');
			Route::post('/add', 'CategoryController@add')->name('category.add');
			Route::get('/edit/{id}', 'CategoryController@showEdit')->name('category.showEdit');
			Route::post('/edit/{id}', 'CategoryController@edit')->name('category.edit');
			Route::delete('/delete/{id}', 'CategoryController@delete')->name('category.delete');
		});
		/////////category/////
		Route::group(['prefix' => 'age'], function(){
			Route::get('/', 'AgeController@index')->name('age.index');
			Route::get('create', 'AgeController@create')->name('age.create');
			Route::post('create', 'AgeController@store')->name('age.store');
			Route::get('edit/{id}', 'AgeController@edit')->name('age.edit');
			Route::post('edit/{id}', 'AgeController@update')->name('age.update');
			Route::delete('delete/{id}', 'AgeController@destroy')->name('age.destroy');
		});
		///////story//////
		Route::group(['prefix' => 'story'], function(){
			Route::get('/', 'StoryController@index')->name('story.index');
			Route::get('/create', 'StoryController@create')->name('story.create');
			Route::post('/create', 'StoryController@store')->name('story.store');
			Route::get('/detail/{id}', 'StoryController@detail')->name('story.detail');
			Route::get('/edit/{id}', 'StoryController@edit')->name('story.edit');
			Route::post('/edit/{id}', 'StoryController@update')->name('story.update');
			Route::delete('/delete/{id}', 'StoryController@destroy')->name('story.destroy');
		});
	});
});
Route::fallback(function() {
    return abort(404);
});