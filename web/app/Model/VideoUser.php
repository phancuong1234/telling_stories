<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VideoUser extends Model
{
	protected $table = 'videos_user';

	protected $fillable = [
		'path', 'user_id', 'story_id',
	];
}
