<?php

phpinfo();
die();

define('DS', DIRECTORY_SEPARATOR);
define('ABS_PATH', realpath(dirname(__FILE__)) . DS);

require_once ABS_PATH . 'app/lib/init.php';
