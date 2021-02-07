<?php

class SingletonDB
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=tuxerdb', "root", "");
        }
        return self::$instance;
    }
}
