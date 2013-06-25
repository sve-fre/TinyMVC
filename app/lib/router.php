<?php

class Router {

    private static function _error() {
        $error_404 = Config::get('app.error_controller');
        $error_404_file = path('controller') . $error_404 . '.php';

        if (is_readable($error_404_file)) {
            include $error_404_file;
            $controller = new $error_404();

            if (method_exists($controller, 'index')) {
                call_user_func(array($controller, 'index'));
            }
        } else {
            die('Could not find error controller: <code>' . Config::get('aṕp.error_controller') . '</code>');
        }
    }

    public static function listen() {
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
