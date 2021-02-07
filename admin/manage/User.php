<?php

class User
{
    public $id;
    public $image;
    public $email;
    public $username;
    public $password;

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

    public function __construct2($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function __construct3($email, $username, $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function __construct4($id, $email, $username, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function __construct5($id, $image, $email, $username, $password)
    {
        $this->id = $id;
        $this->image = $image;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    function set_email($email)
    {
        $this->email = $email;
    }

    function get_email()
    {
        return $this->email;
    }

    function set_username($username)
    {
        $this->username = $username;
    }

    function get_username()
    {
        return $this->username;
    }

    function set_password($password)
    {
        $this->password = $password;
    }

    function get_password()
    {
        return $this->password;
    }
}
