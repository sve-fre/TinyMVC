<?php

class Session {

    private static $_initialized = false;

    public static function init() {
        if (!self::$_initialized) {
            session_start();

            self::$_initialized = true;
        }
    }


    public static function make($key, $value, $overwrite = false) {
        self::init();

        if (!$overwrite) {
            if (!isset($_SESSION[$key])) {
                $_SESSION[$key] = $value;
            }
        } else {
            $_SESSION[$key] = $value;
        }

        return $_SESSION[$key];
    }


    public static function get($key) {
        self::init();

        return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
    }


    public static function delete($key) {
        if (self::get($key) !== null) {
            unset($_SESSION[$key]);
        }
    }

}
