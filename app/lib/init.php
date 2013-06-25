<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ABS_PATH . 'app/lib/config.php';
require_once ABS_PATH . 'app/lib/functions.php';
require_once ABS_PATH . 'app/lib/request.php';
require_once ABS_PATH . 'app/lib/router.php';
require_once ABS_PATH . 'app/lib/db.php';
require_once ABS_PATH . 'app/lib/view.php';

Router::register('testroute', 'home@testroute');

Router::listen();
