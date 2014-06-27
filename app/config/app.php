<?php

return array(
    'environment' => array(
        0 => array(
            'base_url' => 'http://localhost/TinyMVC/',      // trailing slash required
            'db_host' => 'localhost',                       // mysql database host name
            'db_user' => 'root',                            // mysql database user name
            'db_password' => '',                            // mysql database password
            'db_name' => '',                                // mysql database name
            'mod_rewrite' => false,                         // (true|false) rename "htaccess.txt" to ".htaccess" => you'll get clean URLs
            'workmode' => 'dev',                            // (dev|live) set error displays
        ),
        1 => array(
            'base_url' => 'http://localhost:88/TinyMVC/',   // trailing slash required
            'db_host' => 'localhost',                       // mysql database host name
            'db_user' => 'root',                            // mysql database user name
            'db_password' => '',                            // mysql database password
            'db_name' => '',                                // mysql database name
            'mod_rewrite' => false,                         // (true|false) rename "htaccess.txt" to ".htaccess" => you'll get clean URLs
            'workmode' => 'dev',                            // (dev|live) set error displays
        )
    ),

    'title' => 'TinyMVC',                           // title of your project
    'title_separator' => ' | ',                     // used between base title and page title

    'default_controller' => 'home',                 // the controller used, when current URL == Base URL
    'default_action' => 'index',                    // the default method name of a controller, when just http://www.example.com/controller is called
    'error_controller' => 'error_404',              // controller gets called when Router doesn't find a controller
    'view_extension' => '.tpl.php',                 // extension of view files, once declared here, you just purely use view's name, when working with views
    'layout_extension' => '.tpl.php',               // extension of layout files, once declared here, you just purely use layout's name, when working with views
    'storage_extension' => '.storage',              // extension of storage files
    'storage_column_separator' => '|',              // the character(s) for separating the columns in a storage file

    'enable_plugins' => true,                       // enable plugins?
    'mb_internal_encoding' => 'UTF-8',              // set encoding for internal PHP functions
);
