<?php
namespace App\Services;

class UserValidator extends ValidateFile
{
	public static $rules = array(
		'name' => 'required',
		'email' => 'required',
		'avatar' => 'required',
		'password' => 'required|min:8',
		'address' => 'required',
		'gender' => 'required',
		'birthday' => 'required',
		'role' => 'required',
	);
}