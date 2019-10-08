<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', 'Api\UserController@index');
Route::get('/user', 'Api\Auth\UserController@index');

Route::post('/user/register', 'Api\Auth\RegisterController@register');
Route::post('/user/login', 'Api\Auth\LoginController@login');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {

	Route::get('', 'AdminController@index')->name('admin.index');
	// Route::group(['prefix' => 'user','namespace'=>'user'], function(){
	// 	Route::get('/', 'UserController@index')->name('admin.user.index');

	// 	// Route::post('/add', 'UserController@store')->name('admin.user.add');

	// 	// Route::get('/edit/{id}', 'UserController@getedit')->name('admin.user.edit');
	// 	// Route::post('/edit/{id}', 'UserController@postedit')->name('admin.user.edit1');

	// 	// Route::get('/delete/{id}', 'UserController@xoa')->name('admin.user.delete');
	// 	// Route::get('/block/{id}', 'UserController@block')->name('admin.user.block');
	// 	// Route::get('/unblock/{id}', 'UserController@unblock')->name('admin.user.unblock');
	// });

});