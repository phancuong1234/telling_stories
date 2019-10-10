<?php
namespace App\Services;

class ValidateFile {

    protected $input;
    public $messages;
    public static $rules;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function fails()
    {
        $validation = \Validator::make($this->input, static::$rules);

        if ($validation->fails())
        {
            $this->messages = $validation->messages();
            return true;
        }

        return false;
    }

    public function messages()
    {
        return $this->messages;
    }
}