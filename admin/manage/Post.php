<?php

class Post
{
    public $id;
    public $user_id;
    public $text;

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct1($a1)
    {
    }

    public function __construct2($user_id, $text)
    {
        $this->user_id = $user_id;
        $this->text = $text;
    }

    public function __construct3($id, $user_id, $text)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->text = $text;
    }

    function set_id($id)
    {
        $this->id = $id;
    }

    function get_id()
    {
        return $this->id;
    }

    function set_user_id($user_id)
    {
        $this->user_id = $user_id;
    }

    function get_user_id()
    {
        return $this->user_id;
    }

    function set_text($text)
    {
        $this->text = $text;
    }

    function get_text()
    {
        return $this->text;
    }
}
