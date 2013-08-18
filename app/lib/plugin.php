<?php

class Plugin {

    private static $_hooks = array();
    private static $_plugins = array();
    private static $_invalid_plugins = array();
    private static $_valid_plugins = array();


    public static function init() {
        self::get();
        self::validate();
    }


    public static function get() {
        $plugin_dir = path('plugin');

        if (!is_readable($plugin_dir)) {
            return;
        }

        File::get($plugin_dir, function($files) {
            if ($files && count($files)) {
                foreach ($files as $key => $file) {
                    self::$_plugins[] = $file;
                }
            }
        });
    }


    public static function validate() {
        $plugins = self::$_plugins;

        if (count($plugins)) {
            foreach (self::$_plugins as $plugin) {
                $plugin_dir = $plugin['file_path'];
                $plugin = $plugin_dir . DS . 'plugin.php';

                if (!is_readable($plugin_dir) || !is_readable($plugin)) {
                    self::$_invalid_plugins[] = $plugin;
                    continue;
                }

                self::$_valid_plugins[] = $plugin;
            }
        }
    }


    public static function registerHook($hook, $data = null) {
        if (!$data) {
            self::$_hooks[] = $hook;
        }

        $hook = array($hook, $data);
        self::$_hooks[] = $hook;
        self::call($hook);
    }


    public static function call($hook) {
        print_r(self::$_valid_plugins);
    }

}
