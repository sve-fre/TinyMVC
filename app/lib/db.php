<?php

class DB {

    private static $_connected = false;
    private static $_connection = null;
    private static $_instance = null;
    private static $_table = null;
    private static $_order_by_column = null;
    private static $_direction = null;
    private static $_limit = null;
    private static $_where = null;


    public static function connect() {
        if (self::$_connected === true) {
            return;
        }

        self::$_connection = mysql_connect(
            Config::get('app.db_host'),
            Config::get('app.db_user'),
            Config::get('app.db_password')
        ) or die('Could not connect to database server.');

        mysql_select_db(
            Config::get('app.db_name'),
            self::$_connection
        ) or die ('Could not select database.');

        mysql_query("SET CHARACTER SET utf8");

        self::$_connected = true;
    }


    public static function table($table) {
        self::$_table = (is_array($table)) ? implode(',', $table) : $table;

        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        DB::connect();

        return self::$_instance;
    }


    public function orderBy($order_by_column, $direction = null) {
        self::$_order_by_column  = '`' . $order_by_column . '`';
        self::$_direction = ($direction) ? strtoupper($direction) : 'ASC';

        return $this;
    }


    public function limit($one, $two = null) {
        $length = ($two === null) ? (int)$one : (int)$two;
        $offset = ($two !== null) ? (int)$one : null;

        if ($offset && $length) {
            self::$_limit = "LIMIT {$offset}, {$length}";
        } else {
            self::$_limit = "LIMIT {$length}";
        }

        return $this;
    }


    public function where($column, $operator, $value) {
        $value = (is_string($value)) ? '"' . $value . '"' : $value;
        self::$_where = 'WHERE ' . $column . ' ' . $operator . ' ' . $value;

        return $this;
    }


    public function get($columns = null) {
        $table = self::$_table;
        $order_by_column = self::$_order_by_column;
        $direction = self::$_direction;
        $order_by = (self::$_order_by_column !== null) ? "ORDER BY {$order_by_column} {$direction}" : '';
        $limit = (self::$_limit !== null) ? self::$_limit : '';
        $where = (self::$_where !== null) ? self::$_where : '';

        if (!$columns) {
            $columns = '*';
        } else {
            if (is_array($columns)) {
                $columns = implode(',', $columns);
            } else {
                $columns = '`' . $columns . '`';
            }
        }

        $query = "SELECT {$columns} FROM {$table} {$where} {$order_by} {$limit}";
        $query = mysql_query($query);

        if (mysql_num_rows($query)) {
            while ($row = mysql_fetch_assoc($query)) {
                $output[] = $row;
            }
            return $output;

        } else {
            return array();
        }
    }


    public static function raw($query) {
        DB::connect();

        $query = mysql_query($query);

        if (mysql_num_rows($query)) {
            while ($row = mysql_fetch_assoc($query)) {
                $output[] = $row;
            }

            return $output;
        } else {
            return array();
        }
    }

}
