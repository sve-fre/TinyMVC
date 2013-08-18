<?php

class App {

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
