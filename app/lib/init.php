<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ABS_PATH . 'app/lib/functions.php';

function __autoload($class) {
    $class = ABS_PATH . 'app/lib/' . strtolower($class) . '.php';

    if (!is_readable($class)) {
        return;
    }

    require_once $class;
}

if (Config::get('app.tinymvc_dashboard_url')) {
    Router::register(Config::get('app.tinymvc_dashboard_url'), 'tinymvc_dashboard@index');
}

if (Config::get('app.enable_plugins')) {
    Plugin::getPlugins();
}

require_once ABS_PATH . 'app/lib/routes.php';

Router::listen();
