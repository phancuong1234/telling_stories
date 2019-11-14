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




Route::namespace('Api')->group(function() {
	Route::post('/user/register', 'UserController@register');
	Route::post('/user/login', 'UserController@login');
	Route::post('/password/send_mail', 'UserController@sendMail');
	Route::get('/find/{token}', 'UserController@find');
	Route::post('/password/reset', 'UserController@resetPassword');
	Route::group(['middleware' => 'checkToken'], function () {
		//user
		Route::post('/logout', 'UserController@logout');
		Route::get('/profile', 'UserController@getUserdata');
		Route::post('/profile/edit', 'UserController@editProfile');
		Route::post('/user/change_password', 'UserController@changePassword');
		Route::post('/user/feedback', 'UserController@sendFeedback');
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
		Route::post('/video/vote', 'VideoUserController@voteVideo');
	//result test
		Route::get('/result_test', 'ResultTestController@getPointByUser');
		Route::get('/result_test/story', 'ResultTestController@getResultTest');
		Route::get('/result_test/ranking', 'ResultTestController@getRankingResultTest');

	//comment
		Route::post('/comment/create', 'CommentController@createComment');

	});
});