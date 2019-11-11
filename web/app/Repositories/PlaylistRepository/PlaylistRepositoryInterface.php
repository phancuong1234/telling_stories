<?php

namespace App\Repositories\PlaylistRepository;

interface PlaylistRepositoryInterface
{
	public function getPlaylists($id);
	public function getStoryPlaylist($playlist_id);

	public function createPlaylist($user_id, $name);

	public function addStoryPlaylist($data);
}