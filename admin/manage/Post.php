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
}
