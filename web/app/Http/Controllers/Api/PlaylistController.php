<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PlaylistRepository\PlaylistRepositoryInterface;
use Illuminate\Http\Response;

class PlaylistController extends Controller
{
	protected $playlist;

	public function __construct(PlaylistRepositoryInterface $playlist)
	{
		$this->playlist = $playlist;
	}
    //api get playlists
	public function getPlaylists(Request $request)
	{
		if($request->isMethod('get')){
			$dataPlaylists= $this->playlist->getPlaylists($request->id);
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
			$dataStoryPlaylist= $this->playlist->getStoryPlaylist($request->id);
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
}
