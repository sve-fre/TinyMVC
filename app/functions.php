<?php

function path($path = '') {
    if (!$path) {
        return ABS_PATH;
    }

    switch ($path) {
        case '':
        case '/':
            return ABS_PATH;
            break;
        case 'app':
            return ABS_PATH . 'app' . DS;
            break;
        case 'config':
            return path('app') . 'config' . DS;
            break;
        case 'controller':
            return path('app') . Config::get('app.controller_dir') . DS;
            break;
        case 'lib':
            return path('app') . 'lib' . DS;
            break;
        case 'model':
            return path('app') . Config::get('app.model_dir') . DS;
            break;
        case 'plugin':
            return path('app') . Config::get('app.plugin_dir') . DS;
            break;
        case 'storage':
            return path('app') . Config::get('app.storage_dir') . DS;
            break;
        case 'view':
            return path('app') . Config::get('app.view_dir') . DS;
            break;
        default:
            return ABS_PATH;
    }
}

function url($url = '') {
    $base_url = Config::get('app.base_url');

    if (!$url) {
        return $base_url;
    }

    return (Config::get('app.mod_rewrite') === false) ? $base_url . 'index.php?' . $url : $base_url . $url;
}

function slug($str) {
    $str = mb_strtolower(trim($str));
    $str = strip_tags($str);

    $find = array('ä', 'á', 'à', 'ü', 'ö', 'ß', 'é', 'è');
    $replace = array('ae', 'a', 'a', 'ue', 'oe', 'e', 'e');
    $str = str_replace($find, $replace, $str);

    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', '-', $str);
    $str = trim($str, '-');

    return $str;
}

function title($title = '') {
    if (!$title) {
        return Config::get('app.title');
    }

    return $title . Config::get('app.title_separator') . Config::get('app.title');
}

function d() {
    array_map(
        function($x) {
            echo '<pre style="font-family: monospace; margin: 1em; padding: .5em; border: 1px solid #ddd; background-color: #fff; color: #000; overflow: auto;">';
            var_dump($x);
            echo '</pre>';
        }, func_get_args()
    );
}

function protect($str) {
    return mysql_real_escape_string(strip_tags(trim($str)));
}

function backtick($value) {
    return (is_string($value) && strpos($value, '.') === false) ? '`' . $value . '`' : $value;
}

function quote($value) {
    return (is_string($value)) ? '"' . $value . '"' : $value;
}

function getData($uri) {
    $local_path = (realpath(dirname($uri)));

    if ($local_path) {
        return ($content = file_get_contents($uri)) ? $content : '';
    } else {
        if (in_array('curl', get_loaded_extensions())) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } elseif (ini_get('allow_url_fopen')) {
            return ($content = file_get_contents($uri)) ? $content : false;
        }

        return false;
    }
}
