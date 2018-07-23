<?php
namespace app\index\controller;

class Single
{
    private static $instance = null;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance(): Single
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}

$obj = Single::getInstance();
var_dump($obj);