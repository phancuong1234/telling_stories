<?php
namespace App\Services;

class CategoryValidator extends ValidateFile
{
    public static $rules = array(
        'category'     => 'required',
    );
}