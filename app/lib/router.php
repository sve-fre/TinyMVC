<?php

class Router {

    public static function listen() {
        $controller = Request::controller();
        $controller_file = path('controller') . $controller . '.php';
        $action = Request::action();

        if (is_readable($controller_file)) {
            include $controller_file;
            $controller = new $controller();

            if (method_exists($controller, $action)) {
                call_user_func(array($controller, $action));
            }
        }
    }

}
