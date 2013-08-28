<?php

class App {

    public static function init() {
        App::setWorkMode(Config::get('app.workmode'));
        mb_internal_encoding(Config::get('app.mb_internal_encoding'));

        if (Config::get('app.enable_plugins')) {
            Plugin::init();
        }
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
