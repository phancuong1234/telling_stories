<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PlaylistRepository\PlaylistRepositoryInterface;
use Illuminate\Http\Response;
use App\Repositories\UserRepository\UserRepositoryInterface;

class PlaylistController extends Controller
{
	protected $playlist;
	protected $user;

	public function __construct(PlaylistRepositoryInterface $playlist, UserRepositoryInterface $user)
	{
		$this->playlist = $playlist;
		$this->user = $user;
	}
    //api get playlists
	public function getPlaylists(Request $request)
	{
		if($request->isMethod('get')){
			$token= getallheaders()['token'];
			$user= $this->user->getUserByToken($token);
			$dataPlaylists= $this->playlist->getPlaylists($user->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataPlaylists,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api get story playlist
	public function getStoryPlaylist(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryPlaylist= $this->playlist->getStoryPlaylist($request->playlist_id);

			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryPlaylist,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api create playlist
	public function createPlaylist(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);
		//dd($request->name);
		$playlist= $this->playlist->createPlaylist($user->id, $request->name);
		return response()->json([
			'code'  => Response::HTTP_OK,
			'data' => $playlist,
		]); 
	}

	//add story playlist
	public function addStoryPlaylist(Request $request)
	{

		$addPlaylist= $this->playlist->addStoryPlaylist($request->all());
		if($addPlaylist == 0){
			return response()->json([
				'code'  => FAIL,
				'message' => EXISTED,
			]);
		}
		if($addPlaylist == 1){
			return response()->json([
				'code'  => Response::HTTP_OK,
				'message' => ADD_STORY_SUCCESS,
			]);
		}
	}
}
