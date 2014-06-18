<?php

class Storage2 {

    private $_storages = array();
    private static $_dir = '';
    private static $_extension = '';
    private static $_separator = '';
    private static $_init = false;
    private $_instance = null;


    private static function _init() {
        self::$_dir = path('storage');
        self::$_extension = Config::get('app.storage_extension');
        self::$_separator = Config::get('app.storage_column_separator');
    }


    public static function make($storage, $columns) {
        if (!self::$_init) {
            self::$_init = true;
            self::_init();
        }

        $storage = self::_file($storage);

        if (!is_array($columns) || !count($columns) || self::exists($storage)) {
            return false;
        }


        if (!in_array('id', $columns)) {
            array_unshift($columns, 'id');
        }

        $columns = implode('|', $columns);
        File::make($storage);

        return (File::write($storage, $columns)) ? true : false;
    }


    private static function _read($storage) {
        if (!self::$_init) {
            self::$_init = true;
            self::_init();
        }

        if (!self::exists($storage)) {
            return false;
        }

        return file(self::_file($storage));
    }


    public function insert($storage, $data) {
        if (!self::exists($storage) || !is_array($data)) {
            return false;
        }
    }


    public static function get() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }


    public static function exists($storage) {
        if (!self::$_init) {
            self::$_init = true;
            self::_init();
        }

        $storage = self::_file($storage);

        return (File::exists($storage) && File::isReadable($storage));
    }


    private static function _file($storage) {
        return self::$_dir . $storage . self::$_extension;
    }


    public static function test() {
        return self::_read('test');
    }

}
