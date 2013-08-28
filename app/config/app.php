<?php

return array(
    'base_url' => 'http://localhost/TinyMVC/',            // trailing slash required
    'mod_rewrite' => false,                               // (true|false) rename "htaccess.txt" to ".htaccess" => you'll get clean URLs
    'install_dir' => dirname(dirname(dirname(__FILE__))), // installation directory of TinyMVC

    'title' => 'TinyMVC',                           // title of your project
    'title_separator' => ' | ',                     // used between base title and page title

    'view_dir' => 'view',                           // within app/ dir
    'controller_dir' => 'controller',               // within app/ dir
    'model_dir' => 'model',                         // within app/ dir
    'plugin_dir' => 'plugin',                       // within app/ dir

    'default_controller' => 'home',                 // the controller used, when current URL == Base URL
    'default_action' => 'index',                    // the default method name of a controller, when just http://www.example.com/controller is called
    'error_controller' => 'error_404',              // controller gets called when Router doesn't find a controller
    'view_extension' => '.tpl.php',                 // extension of view files, once declared here, you just purely use view's name, when working with views
    'layout_extension' => '.tpl.php',               // extension of layout files, once declared here, you just purely use layout's name, when working with views

    'db_host' => 'localhost',                       // mysql database host name
    'db_user' => 'root',                            // mysql database user name
    'db_password' => '',                            // mysql database password
    'db_name' => '',                                // mysql database name

    'enable_plugins' => true,                       // enable plugins?
    'workmode' => 'dev',                            // (dev|live) set error displays
    'mb_internal_encoding' => 'UTF-8',              // set encoding for internal PHP functions
);
