<?php

require_once ABS_PATH . 'app/functions.php';
require_once path('app') . 'routes.php';

function __autoload($class) {
    $class = path('class') . $class . '.php';

    if (!is_readable($class)) {
        return;
    }

    require_once $class;
}

App::init();
