<?php
namespace App\Services;

class UserValidator extends ValidateFile
{
	public static $rules = array(
		'name' => 'required',
		'email' => 'required',
		'password' => 'required|min=8',
		'gender' =>	'required',
		'birthday' => 'required',
		'avatar' => 'required',
		'role_id' => 'required',
	);
}