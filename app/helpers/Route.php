<?php

namespace App\Helpers;

class Route
{
    public static function get(string $url, $fallback)
    {
        $request = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        if($request === url($url) && $method === "GET") {
            static::action($fallback);
        }
        if($method !== "GET") {
            echo ("'$method' Method not supported for this route. Supported method is 'GET'");
            die;
        }
    }

    public static function post(string $url, $fallback)
    {
        $request = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        if($request === url($url) && $method === "POST") {
            static::action($fallback);
        }
        if($method !== "POST") {
            echo ("'$method' Method not supported for this route. Supported method is 'POST'");
            die;
        }
    }

    public static function action($action)
    {
        if(is_array($action)) {
            $class = new $action[0];
            $fnc = $action[1];
            return $class->$fnc();
        } else {
            $action();
        }
    }
}