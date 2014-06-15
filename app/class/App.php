<?php

class App {

    private static $_initialized = false;

    private static function _setEnvironment() {
        if (count(Config::get('app.environment'))) {
            foreach (Config::get('app.environment') as $env) {
                if (String::contains($env['base_url'], $_SERVER['HTTP_HOST'])) {
                    Config::set('app.base_url', $env['base_url']);
                    Config::set('app.db_host', $env['db_host']);
                    Config::set('app.db_user', $env['db_user']);
                    Config::set('app.db_password', $env['db_password']);
                    Config::set('app.db_name', $env['db_name']);
                    Config::set('app.db_wrapper', $env['db_wrapper']);
                    Config::set('app.mod_rewrite', $env['mod_rewrite']);
                    Config::set('app.workmode', $env['workmode']);
                    break;
                }
            }
        }
    }


    private static function _getInstallDir() {
        return dirname(dirname(dirname(__FILE__)));
    }


    public static function init() {
        if (!self::$_initialized) {
            App::setWorkMode(Config::get('app.workmode'));
            mb_internal_encoding(Config::get('app.mb_internal_encoding'));

            if (File::exists(path('controller') . 'base_controller.php')) {
                require_once path('controller') . 'base_controller.php';
            }

            if (Config::get('app.enable_plugins')) {
                Plugin::init();
            }

            App::_setEnvironment();
            Router::listen();
        }

        self::$_initialized = true;
    }


    public static function setWorkMode($workmode) {
        switch ($workmode) {
            case 'dev':
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                break;
            case 'live':
                ini_set('display_errors', 0);
                error_reporting(0);
                break;
            default:
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                break;
        }
    }


    public static function isInstalledInSubDir() {
        if ($_SERVER['DOCUMENT_ROOT'] === self::_getInstallDir()) {
            return false;
        }

        return true;
    }


    public static function getSubDir() {
        if (!self::isInstalledInSubDir()) {
            return '';
        }

        return trim(substr(self::_getInstallDir(), strlen($_SERVER['DOCUMENT_ROOT'])), DS);
    }

}
