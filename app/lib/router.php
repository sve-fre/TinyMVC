<?php

class Router {

    private static $_skip = false;

    public static function register($route, $todo) {
        if (!$route) {
            return;
        }

        if (strpos($todo, '@') !== false) {
            $todo = explode('@', $todo);
            $controller = $todo[0];
            $action = $todo[1];
            $controller_file = path('controller') . $controller . '.php';

            if (is_readable($controller_file)) {
                include $controller_file;
                $controller = new $controller();

                if (method_exists($controller, $action)) {
                    call_user_func(array($controller, $action));

                    self::$_skip = true;
                } else {
                    Router::_error();
                }
            } else {
                Router::_error();
            }
        } else {
            Router::_error();
        }
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
            die('Could not find error controller: <code>' . Config::get('aṕp.error_controller') . '</code>');
        }
    }

    public static function listen() {
        if (self::$_skip === true) {
            return;
        }

        $controller = Request::controller();
        $controller_file = path('controller') . $controller . '.php';
        $action = Request::action();

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
