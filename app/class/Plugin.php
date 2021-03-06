<?php

class Plugin {

    private static $_hooks = array();
    private static $_plugins = array();
    private static $_invalid_plugins = array();
    private static $_valid_plugins = array();


    public static function init() {
        self::searchPlugins();
        self::validate();
    }


    public static function searchPlugins() {
        $plugin_dir = path('plugin');

        if (!is_readable($plugin_dir)) {
            return;
        }

        Dir::read($plugin_dir, function($files) {
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
                $plugin_file = $plugin_dir . DS . 'plugin.php';

                if (!is_readable($plugin_dir) || !is_readable($plugin_file)) {
                    self::$_invalid_plugins[] = array($plugin, $plugin_file);
                    continue;
                }

                self::$_valid_plugins[] = array($plugin, $plugin_file);
            }
        }
    }


    public static function registerHook($hook, $data = null) {
        if (!Config::get('app.enable_plugins')) {
            return $data;
        }

        if (!$data) {
            self::$_hooks[] = $hook;
        }

        $hook = array($hook, $data);
        self::$_hooks[] = $hook;
        return self::call($hook);
    }


    public static function call($hook) {
        $plugins = self::$_valid_plugins;
        $hook_name = $hook[0];
        $data = $hook[1];

        if (count($plugins)) {
            foreach ($plugins as $plugin) {
                $plugin_file = $plugin[1];
                $plugin_name = $plugin[0]['file_name'];
                include_once $plugin_file;

                $call_function = $plugin[0]['file_name'] . '__' . $hook_name;

                if (function_exists($call_function)) {
                    return $call_function($data);
                }

                return $data;
            }
        }
    }


    public static function getPlugins() {
        return self::$_valid_plugins;
    }

}
