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
Route::group([/*'middleware' => 'jwt.auth'*/], function () {
		//user
	Route::get('/user_data', 'UserController@getUserdata');
        //novel
	Route::get('/story/top_slide', 'StoryController@getTopSlide');
	Route::get('/story/new', 'StoryController@getStoryNew');
	Route::get('/story/popularity', 'StoryController@getStoryPopularity');
	Route::get('/story/recommend', 'StoryController@getStoryRecommend');
	Route::get('/story/detail', 'StoryController@getStoryDetail');
	Route::get('/story/category', 'StoryController@getStoryByCategory');
	Route::get('/story/age', 'StoryController@getStoryByAge');
	Route::get('/story/download', 'StoryController@getStoryDownload');
	Route::get('/story/popularity/week', 'StoryController@getStoryPopularityWeek');
	Route::get('/story/popularity/month', 'StoryController@getStoryPopularityMonth');

		//history
	Route::get('/history', 'HistoryController@getStoryHistoryView');
		//favorite
	Route::get('/favorite', 'FavoriteController@getStoryFavorite');
		//playlist
	Route::get('/playlist', 'PlaylistController@getPlaylists');
	Route::get('/playlist/story', 'PlaylistController@getStoryPlaylist');
		//category
	Route::get('/category/all', 'CategoryController@getListCategory');

		//age
	Route::get('/age/all', 'AgeController@getListAge');
		//video user
	Route::get('/video_user', 'VideoUserController@getCountVideo');
	Route::get('/video_user/ranking', 'VideoUserController@getRankingVideoUser');
	//result test
	Route::get('/result_test', 'ResultTestController@getPointByUser');
	Route::get('/result_test/ranking', 'ResultTestController@getRankingResultTest');

});
});