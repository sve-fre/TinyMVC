<?php

class Storage2 {

    private static $_storages = array();
    private static $_dir = '';
    private static $_extension = '';
    private static $_separator = '';
    private static $_init = false;
    private static $_instance = null;
    private static $_where = array();
    private static $_storage = null;


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

        $columns = implode('|', $columns) . "\n";
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

        if (!isset(self::$_storages[$storage])) {
            self::$_storages[$storage] = file(self::_file($storage));
        }

        return self::$_storages[$storage];
    }


    public static function insert($storage, $data) {
        if (!self::exists($storage) || !is_array($data) || !is_array(self::_read($storage)) || !count(self::_read($storage))) {
            return false;
        }

        $storage_data = self::_read($storage);
        $column_names = explode(self::$_separator, self::_removeNewLines($storage_data[0]));
        $last_id = explode(self::$_separator, $storage_data[count($storage_data) - 1])[0];
        $id = (is_numeric($last_id)) ? $last_id + 1 : 1;
        $tmp_data = array();

        foreach ($data as $column => $value) {
            if (in_array($column, $column_names)) {
                $index = array_keys($column_names, $column)[0];
                $tmp_data[$index] = ($column === 'id') ? $id : $value;
            }
        }

        ksort($tmp_data);
        File::append(self::_file($storage), implode(self::$_separator, $tmp_data). "\n");
    }


    public function where($column, $operator, $value) {
        self::$_where[] = array(
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        );

        return $this;
    }


    public function count() {
        return count(self::$_storage) - 1;
    }


    public static function get($storage) {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        self::$_where = array();
        self::$_storage = self::_read($storage);

        return self::$_instance;
    }


    public static function all($storage) {
        if (!self::exists($storage)) {
            return false;
        }

        return (isset(self::$_storages[$storage])) ? self::$_storages[$storage] : self::_read($storage);
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


    private static function _removeNewLines($str) {
        return str_replace("\n", '', $str);
    }


    public static function test() {
        return self::_read('test');
    }

}
