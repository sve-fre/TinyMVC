<?php

class File {

    public static function create($file, $time = null) {
        $dir = realpath(dirname($file));

        if (!is_readable($dir) || !is_writeable($dir)) {
            return false;
        }

        if (!$time) {
            $time = time();
        }

        return (!touch($file, $time)) ? false : true;
    }


    public static function get($file) {
        if (!is_readable($file)) {
            return false;
        }

        return ($content = file_get_contents($file)) ? $content : false;
    }


    public static function prepend($file, $data) {
        self::_write($file, $data, 'prepend');
    }


    public static function append($file, $data) {
        return self::_write($file, $data, 'append');
    }


    public static function write($file, $data) {
        return self::_write($file, $data, 'write');
    }


    private static function _write($file, $data, $mode) {
        if (!is_readable($file) || !is_writeable($file)) {
            return false;
        }

        if ($mode === 'append') {
            return (file_put_contents($file, $data, FILE_APPEND)) ? true : false;
        } elseif ($mode === 'write') {
            return (file_put_contents($file, $data)) ? true : false;
        } elseif ($mode === 'prepend') {
            $old_content = file_get_contents($file);
            return (file_put_contents($file, $data . $old_content)) ? true : false;
        }
    }

}
