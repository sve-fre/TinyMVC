<?php

class App {

    public static function init() {
        App::setWorkMode(Config::get('app.workmode'));

        if (Config::get('app.tinymvc_dashboard_url')) {
            Router::register(Config::get('app.tinymvc_dashboard_url'), 'tinymvc_dashboard@index');
        }

        if (Config::get('app.enable_plugins')) {
            Plugin::init();
        }

        mb_internal_encoding(Config::get('app.mb_internal_encoding'));
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


    public static function protect($str) {
        return mysql_real_escape_string(strip_tags(trim($str)));
    }


    public static function backtick($value) {
        return (is_string($value) && strpos($value, '.') === false) ? '`' . $value . '`' : $value;
    }


    public static function quote($value) {
        return (is_string($value)) ? '"' . $value . '"' : $value;
    }


    public static function installedInSubdirectory() {
        if ($_SERVER['DOCUMENT_ROOT'] === Config::get('app.install_dir')) {
            return false;
        }

        return true;
    }


    public static function getSubdirectory() {
        if (!self::installedInSubdirectory()) {
            return false;
        }

        return trim(substr(Config::get('app.install_dir'), strlen($_SERVER['DOCUMENT_ROOT'])), DS);
    }

}
