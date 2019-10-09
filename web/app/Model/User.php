<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
	protected $table = 'users';
	protected $fillable = [
		'name', 'email', 'password',
	];
	protected $hidden = [
        'password', 'token',
    ];
    
}
