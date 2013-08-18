<?php

class Plugin {

    private static $_hooks = array();
    private static $_plugins = array();
    private static $_invalid_plugins = array();


    public static function getPlugins() {
        if (!Config::get('app.plugin_dir')) {
            return;
        }

        $plugin_dir = path('plugin');

        if (!is_readable($plugin_dir)) {
            return;
        }

        listFiles($plugin_dir, function($files) {
            if ($files && count($files)) {
                foreach ($files as $key => $file) {
                    self::$_plugins[] = $file;
                }
            }
        });

        return self::$_plugins;
    }


    public static function check() {
        $plugins = self::$_plugins;

        if (count($plugins)) {
            foreach (self::$_plugins as $plugin) {
                $plugin_dir = $plugin['file_path'];
                $plugin = $plugin_dir . DS . 'plugin.php';

                if (is_readable($plugin_dir) || !is_readable($plugin)) {
                    self::$_invalid_plugins[] = $plugin;
                    continue;
                }
            }
        }
    }


    public function registerHook($hook, $data) {

    }

}
