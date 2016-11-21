<?php

class Router
{
    public static function getUri()
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }
}
