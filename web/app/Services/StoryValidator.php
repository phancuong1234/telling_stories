<?php
namespace App\Services;

class StoryValidator extends ValidateFile
{
    public static $rules = array(
        'category'     => 'required',
    );
}