<?php

class base_controller {

    protected static $layout = null;

    public function __construct() {
        self::$layout = 'default';
    }

}
