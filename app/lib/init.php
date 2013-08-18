<?php

require_once ABS_PATH . 'app/lib/functions.php';
require_once path('lib') . 'routes.php';

function __autoload($class) {
    $class = path('lib') . strtolower($class) . '.php';

    if (!is_readable($class)) {
        return;
    }

    require_once $class;
}

App::init();
Router::listen();
//d(Plugin::$_hooks);
