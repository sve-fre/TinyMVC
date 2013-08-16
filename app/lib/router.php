<?php

class Router {

    private static $_routes = array();
    private static $_skip = false;

    public static function register($route, $todo) {
        if (!$route) {
            return;
        }

        if (in_array($route, self::$_routes)) {
            return;
        }

        if (!preg_match('/[a-zA-Z0-9_]\@[a-zA-Z0-9_]/', $todo)) {
            return;
        }

        $todo = explode('@', $todo);
        $controller = $todo[0];
        $action = $todo[1];

        self::$_routes[] = [$route, [$controller, $action]];
    }

    private static function _error() {
        $error_404 = Config::get('app.error_controller');
        $error_404_file = path('controller') . $error_404 . '.php';

        if (is_readable($error_404_file)) {
            include $error_404_file;
            $controller = new $error_404();

            if (method_exists($controller, Config::get('app.default_action'))) {
                call_user_func(array($controller, Config::get('app.default_action')));
            }
        } else {
            die('Could not find error controller: <code>' . Config::get('app.error_controller') . '</code>');
        }
    }

    public static function listen() {
        $routes = self::$_routes;

        if (count($routes)) {
            foreach ($routes as $route) {
                if (ltrim(Request::get(), '/') == $route[0]) {
                    $controller = $route[1][0];
                    $controller_file = path('controller') . $controller . '.php';
                    $action = $route[1][1];
                    self::$_skip = true;

                    break;
                }
            }
        }

        if (self::$_skip === false) {
            $controller = Request::controller();
            $controller_file = path('controller') . $controller . '.php';
            $action = Request::action();
        }

        if (is_readable($controller_file)) {
            include $controller_file;
            $controller = new $controller();

            if (method_exists($controller, $action)) {
                call_user_func(array($controller, $action));
            } else {
                Router::_error();
            }
        } else {
            Router::_error();
        }
    }

}
