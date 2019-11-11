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
Route::post('/user/forgot_password', 'Api\UserController@forgorPassword');


Route::namespace('Api')->group(function() {
Route::group(['middleware' => 'checkToken'], function () {
		//user
	Route::post('/logout', 'UserController@logout');
	Route::get('/profile', 'UserController@getUserdata');
	Route::get('/profile/edit', 'UserController@editProfile');//chua
	Route::get('/user/change_password', 'UserController@changePassword');//chua
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
	Route::get('/story/test', 'StoryController@getStoryQuestion');
	Route::post('/story/test/submit', 'StoryController@submitTest');
	Route::post('/story/download/create', 'StoryController@addStoryDownload');

		//history
	Route::get('/history', 'HistoryController@getStoryHistoryView');
		//favorite
	Route::get('/favorite', 'FavoriteController@getStoryFavorite');
	Route::post('/favorite/add', 'FavoriteController@addFavorite');
		//playlist
	Route::get('/playlist', 'PlaylistController@getPlaylists');
	Route::get('/playlist/story', 'PlaylistController@getStoryPlaylist');
	Route::post('/playlist/create', 'PlaylistController@createPlaylist');
	Route::post('/playlist/add_story', 'PlaylistController@addStoryPlaylist');
		//category
	Route::get('/category/all', 'CategoryController@getListCategory');

		//age
	Route::get('/age/all', 'AgeController@getListAge');
		//video user
	Route::get('/video_user', 'VideoUserController@getCountVideo');
	Route::get('/video_user/ranking', 'VideoUserController@getRankingVideoUser');
	Route::post('/video_user/create', 'VideoUserController@createVideo');
	//result test
	Route::get('/result_test', 'ResultTestController@getPointByUser');
	Route::get('/result_test/story', 'ResultTestController@getResultTest');
	Route::get('/result_test/ranking', 'ResultTestController@getRankingResultTest');

	//comment
	Route::post('/comment/create', 'CommentController@createComment');

});
});