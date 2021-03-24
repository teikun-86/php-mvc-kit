<?php

if(!function_exists('url')) {
    function url(string $path) {
        return "$path";
    }
}

if(!function_exists('view')) {
    function view(string $view, array $data = []) {
        $path = str_replace('.', '/', $view);
        if(file_exists(__DIR__."/../../views/$path.php")) {
            $data = to_object($data);
            return require __DIR__."/../../views/$path.php";
        } else {
            echo "View '$path.php' not found.";
            die;
        }
    }
}

if(!function_exists('component')) {
    function component(string $path, array $data = []) {
        $path = str_replace('.', '/', $path);
        if(file_exists(__DIR__."/../../views/components/$path.php")){
            $data = to_object($data);
            return require __DIR__."/../../views/components/$path.php";
        } else {
            echo "View Component '$path.php' not found.";
            die;
        }
    }
}

if(!function_exists('to_object')) {
    function to_object(array $array) {
        return json_decode(json_encode($array));
    }
}

if(!function_exists('config')) {
    function config(string $key = null, $default = null) {
        $config = require __DIR__."/../../config.php";
        if($key != null) {
            return assignArrayByPath($config, $key, '.', $default);
        } else {
            return $config ?? $default;
        }
    }
}

if(!function_exists('assignArrayByPath')) {
    function assignArrayByPath(array &$array, $path, $delimiter, $default) {
        $keys = explode($delimiter, $path);
        if(count($keys) >= 1) {
            $arr = $array;
            foreach($keys as $key) {
                $arr = isset($arr[$key]) ? $arr[$key] : $default;
            }
            return $arr;
        } else {
            return $array[$path];
        }
    }
}

if(!function_exists('stringify')) {
    function stringify(array $array, bool $withQuote = false) {
        $res = "";
        $i = 0;
        $length = count($array);
        foreach($array as $a) {
            $i ++;
            $res .= $withQuote ? "'$a'" : $a;
            $i === $length ? '' : $res .= ',';
        }
        return $res;
    }
}