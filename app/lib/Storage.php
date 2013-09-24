<?php

class Storage {

    private static $_dir = '';
    private static $_init = false;
    private static $_extension = '';
    private static $_instance = null;
    private static $_storage = '';


    public static function get($storage) {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        if (!self::$_init) {
            self::_init($storage);
        }

        return self::$_instance;
    }


    public function all() {
        $storage = self::_read();

        return $storage;
    }


    public function where($column, $operator, $value) {
        $storage = self::_read();

        if (count($storage)) {
            array_shift($storage);
            foreach ($storage as $row) {
                $row = explode('|', trim($row));

                if (count($row)) {
                    foreach ($row as $row_column => $row_value) {
                        if ($row_column == $value) {
                            $output[] = $value;
                        }
                    }
                }
            }
        }
    }


    private static function _init($storage) {
        self::$_dir = path('storage');
        self::$_extension = '.storage';
        self::$_storage = self::$_dir . $storage . self::$_extension;

        self::$_init = true;
    }


    private static function _removeNewLines($str) {
        return str_replace("\n", '', $str);
    }


    private static function _read() {
        if (!self::exists(self::$_storage)) {
            return false;
        }

        return file(self::$_storage);
    }


    public static function insert($storage, $data = array()) {
        if (!self::$_init) {
            self::_init($storage);
        }

        $storage = self::_read();
        $columns = array_shift($storage);
        $columns = self::_removeNewLines($columns);

        if (count($storage)) {
            $last_row = $storage[count($storage) - 1];
            $last_id = explode('|', $last_row);
            $last_id = $last_id[0] + 1;
        } else {
            $last_id = 1;
        }

        foreach ($columns as $column) {
            if (array_key_exists($column, $data) && $column !== 'id') {
                $output[] = $data[$column];
            } elseif (!array_key_exists($column, $data)) {
                $output[] = '';
            }
        }

        array_unshift($output, $last_id);
        $output = "\n" . implode('|', $output);

        return (file_put_contents(self::$_storage, $output, FILE_APPEND)) ? true : false;
    }


    public static function make($storage, $data = array()) {
        if (!self::exists($storage)) {
            if (!array_key_exists('id', $data)) {
                array_unshift($data, 'id');
            }

            $data = implode('|', $data);

            return (file_put_contents(self::$_storage, $data)) ? true : false;
        }

        return false;
    }


    public static function exists($storage) {
        if (!self::$_init) {
            self::_init($storage);
        }

        if (!is_readable(self::$_storage)) {
            return false;
        }

        return true;
    }

}
