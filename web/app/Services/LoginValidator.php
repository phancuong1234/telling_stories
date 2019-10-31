<?php
namespace App\Services;

class LoginValidator extends ValidateFile
{
    public static $rules = array(
        'email'     => 'required',
        'password'     => 'required',
    );
}