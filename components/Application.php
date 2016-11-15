<?php

class Application
{
    public static $config;

    public function __construct(&$config)
    {
        self::$config = $config;
    }

    public function run()
    {
        //
    }
}
