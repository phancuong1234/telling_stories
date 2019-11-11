<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ResultTest extends Model
{
	protected $table = 'results_test';

	protected $fillable = [
		'count_answer_true', 'point', 'user_id', 'story_id',
	];
}
