<?php

class Request {

    public static function get() {
        $install_dir = Config::get('app.install_dir');
        $req = $_SERVER['REQUEST_URI'];

        if (Config::get('app.mod_rewrite') === true) {
            return str_replace($install_dir, '', ltrim($req, DS));
        }

        if (strpos($req, 'index.php?') !== false) {
            return str_replace($install_dir, '', str_replace('index.php?', '', ltrim($req, DS)));
        } elseif (strpos($req, 'index.php') !== false) {
            return str_replace($install_dir, '', str_replace('index.php', '', ltrim($req, DS)));
        }
    }

    public static function controller() {
        $request = explode('/', self::get());

        return (empty($request[1])) ? Config::get('app.default_controller') : $request[1];
    }

    public static function action() {
        $request = explode('/', self::get());

        return (!isset($request[2])) ? Config::get('app.default_action') : $request[2];
    }

    public static function segments() {
        $request = explode('/', self::get());
        $request = array_slice($request, 3, count($request));

        if (isset($request) && is_array($request) && count($request)) {
            return $request;
        } else {
            return array();
        }
    }

    public static function segment($segment) {
        $segment = ($segment < 1) ? 1 : (int)$segment - 1;
        $request = explode('/', self::get());
        $request = array_slice($request, 3, count($request));

        return (isset($request[$segment])) ? $request[$segment] : null;
    }

}
