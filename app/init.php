<?php

require_once ABS_PATH . 'app/functions.php';
require_once path('app') . 'routes.php';
require_once path('controller') . 'base_controller.php';

function __autoload($class) {
    $class = path('lib') . $class . '.php';

    if (!is_readable($class)) {
        return;
    }

    require_once $class;
}

App::init();
Router::listen();
