<?php

mb_internal_encoding("UTF-8");

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
        case 'controller':
            return path('app') . Config::get('app.controller_dir') . DS;
            break;
        case 'model':
            return path('app') . Config::get('app.model_dir') . DS;
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
    if (!$str) {
        return;
    }
    $str = mb_strtolower(trim($str));
    $str = strip_tags($str);
    $str = str_replace('ä', 'ae', $str);
    $str = str_replace('ü', 'ue', $str);
    $str = str_replace('ö', 'oe', $str);
    $str = str_replace('ß', 'ss', $str);
    $str = str_replace('è', 'e', $str);
    $str = str_replace('é', 'e', $str);
    $str = str_replace('á', 'a', $str);
    $str = str_replace('à', 'a', $str);
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', '-', $str);
    $str = trim($str, '-');
    return $str;
}
