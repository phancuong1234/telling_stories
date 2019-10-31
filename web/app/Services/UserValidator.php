<?php
namespace App\Services;

class UserValidator extends ValidateFile
{
	public static $rules = array(
		'name' => 'required',
		'email' => 'required',
	);
}