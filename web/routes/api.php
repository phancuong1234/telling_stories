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

Route::post('/user/register', 'Api\UserController@register');
Route::post('/user/login', 'Api\UserController@login');


Route::namespace('Api')->group(function() {
	Route::group(['middleware' => 'jwt.auth'], function () {
		//user
		Route::get('/user_data', 'UserController@getUserdata');
        //novel
        Route::get('/story/top_slide', 'StoryController@getTopSlide');
        Route::get('/story/new_all', 'StoryController@getStoryNewAll');
		Route::get('/story/new', 'StoryController@getStoryNew');
		Route::get('/story/popularity', 'StoryController@getStoryPopularity');
		Route::get('/story/popularity_all', 'StoryController@getStoryPopularityAll');
		Route::get('/story/detail', 'StoryController@getStoryDetail');

	});
});