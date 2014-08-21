<?php

class Request {

    public static function get() {
        $install_dir = (App::isInstalledInSubDir()) ? App::getSubDir() : '';
        $req = (App::isInstalledInSubDir()) ? ltrim($_SERVER['REQUEST_URI'], '/') : $_SERVER['REQUEST_URI'];

        if (!Config::get('app.mod_rewrite')) {
            $req = str_replace(
                array('index.php?', 'index.php'),
                array('', ''),
                $req
            );
        }

        return str_replace($install_dir, '', $req);
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
        $request = array_filter(explode('/', self::get()));

        if (isset($request) && is_array($request) && count($request)) {
            return $request;
        }

        return array();
    }


    public static function segment($segment) {
        $segment = (int)$segment + 1;
        $request = array_values(explode('/', self::get()));

        return (isset($request[$segment])) ? $request[$segment] : null;
    }

}
