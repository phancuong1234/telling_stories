<?php
namespace App\Services;

class AgeValidator extends ValidateFile
{
    public static $rules = array(
        'category'     => 'required',
    );
}