<?php

namespace App\Repositories\PlaylistRepository;

interface PlaylistRepositoryInterface
{
    public function getPlaylists($id);
    public function getStoryPlaylist($playlist_id);
}