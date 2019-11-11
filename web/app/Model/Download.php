<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'downloads';

    protected $fillable = ['user_id','video_id'];
}
