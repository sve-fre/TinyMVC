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
    private static $_or_where = array();
    private static $_and_where = array();


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
        self::$_order_by_column  = backtick($order_by_column);
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
        $value = quote(protect($value));
        self::$_where = 'WHERE ' . $column . ' ' . $operator . ' ' . $value;

        return $this;
    }


    public function orWhere($column, $operator, $value) {
        $value = quote(protect($value));
        self::$_or_where[] = 'OR ' . $column . ' ' . $operator . ' ' . $value;

        return $this;
    }


    public function andWhere($column, $operator, $value) {
        $value = quote(protect($value));
        self::$_and_where[] = ' AND ' . $column . ' ' . $operator . ' ' . $value;

        return $this;
    }


    public function prepare($columns = null) {
        $sql = array();
        $sql['table'] = backtick(self::$_table);
        $sql['order_by_column'] = $order_by_column = self::$_order_by_column;
        $sql['direction'] = $direction = self::$_direction;
        $sql['order_by'] = (self::$_order_by_column !== null) ? "ORDER BY {$order_by_column} {$direction}" : '';
        $sql['limit'] = (self::$_limit !== null) ? self::$_limit : '';
        $sql['where'] = (self::$_where !== null) ? self::$_where : '';
        $sql['or_where'] = (count(self::$_or_where)) ? implode(' ', self::$_or_where) : '';
        $sql['and_where'] = (count(self::$_and_where)) ? implode(' ', self::$_and_where) : '';

        if (!$columns) {
            $sql['columns'] = '*';
        } else {
            if (is_array($columns)) {
                $columns = array_map(function($item) {
                    return backtick($item);
                } , $columns);
                $sql['columns'] = implode(',', $columns);
            } else {
                $sql['columns'] = backtick($columns);
            }
        }

        // Reset stuff
        self::$_order_by_column = null;
        self::$_direction = null;
        self::$_limit = null;
        self::$_where = null;
        self::$_or_where = array();
        self::$_and_where = array();

        return $sql;
    }


    public function get($columns = null) {
        $sql = self::prepare($columns);
        $columns = $sql['columns'];
        $table = $sql['table'];
        $where = $sql['where'];
        $or_where = $sql['or_where'];
        $and_where = $sql['and_where'];
        $order_by = $sql['order_by'];
        $limit = $sql['limit'];

        $query = trim("SELECT {$columns} FROM {$table} {$where} {$or_where} {$and_where} {$order_by} {$limit}");
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


    public function update($update = array()) {
        $sql = self::prepare();
        $table = $sql['table'];
        $where = $sql['where'];
        $or_where = $sql['or_where'];
        $and_where = $sql['and_where'];
        $limit = $sql['limit'];
        $tmp = array();

        foreach ($update as $key => $value) {
            $value = quote(protect($value));
            $tmp[] = backtick($key) . ' = ' . $value;
        }

        $sql = implode(', ', $tmp);
        $query = trim("UPDATE {$table} SET {$sql} {$where} {$or_where} {$and_where} {$limit}");
        mysql_query($query);
    }


    public function delete() {
        $sql = self::prepare();
        $table = $sql['table'];
        $where = $sql['where'];
        $or_where = $sql['or_where'];
        $and_where = $sql['and_where'];
        $limit = $sql['limit'];
        $tmp = array();

        $query = trim("DELETE FROM {$table} {$where} {$or_where} {$and_where} {$limit}");
        mysql_query($query);
    }


    public function insert($insert = array()) {
        $sql = self::prepare();
        $table = $sql['table'];
        $columns = array();
        $values = array();

        foreach ($insert as $key => $value) {
            $columns[] = backtick($key);
            $values[] = quote(protect($value));
        }

        $insert = '(' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';

        $query = trim("INSERT INTO {$table} {$insert}");
        mysql_query($query);
    }


    public static function raw($query) {
        DB::connect();

        $instruction = explode(' ', $query);
        $instruction = strtoupper($instruction[0]);
        $return_resource = array('SELECT', 'SHOW', 'DESCRIBE', 'EXPLAIN');

        if (!in_array($instruction, $return_resource)) {
            return mysql_query($query);
        }

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
