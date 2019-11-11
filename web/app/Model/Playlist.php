<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlists';
    protected $fillable = ['name','user_id'];
}
