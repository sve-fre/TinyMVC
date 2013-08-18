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

function dd() {
    array_map(
        function($x) {
            var_dump($x);
        }, func_get_args()
    );
    die();
}

function installedInSubdirectory() {
    if ($_SERVER['DOCUMENT_ROOT'] === Config::get('app.install_dir')) {
        return false;
    }

    return true;
}

function getSubdirectory() {
    if (!installedInSubdirectory()) {
        return false;
    }

    return trim(substr(Config::get('app.install_dir'), strlen($_SERVER['DOCUMENT_ROOT'])), DS);
}
