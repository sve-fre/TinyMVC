<?php

class base_controller {

    protected static $layout = null;
    protected static $breadcrumb_config = array();

    public function __construct() {
        self::$layout = 'default';
        self::$breadcrumb_config = array(
            'show_home' => true,
            'home_title' => 'Home'
        );
    }

}
