<?php
namespace App\Services;

class UserValidatorEdit extends ValidateFile
{
	public static $rules = array(
		'name' => 'required',
		'avatar' => 'required',
		'address' => 'required',
		'gender' => 'required',
		'birthday' => 'required',
		'role' => 'required',
	);
}