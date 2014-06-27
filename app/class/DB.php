<?php

class DB {

    private static $_instance = null;
    private $_db_host = null;
    private $_db_user = null;
    private $_db_password = null;
    private $_db_name = null;
    private $_db_connection = null;
    private $_db_errors = array();


    public static function instance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }


    private function __construct() {
        $this->_db_host = Config::get('app.db_host');
        $this->_db_user = Config::get('app.db_user');
        $this->_db_password = Config::get('app.db_password');
        $this->_db_name = Config::get('app.db_name');

        $this->_connect();
    }


    private function _connect() {
        try {
            $this->_db_connection = new PDO('mysql:host=' . $this->_db_host . ';dbname=' . $this->_db_name, $this->_db_user, $this->_db_password);
        } catch (PDOException $e) {
            $this->_db_errors[] = 'Could not connect to database (using PDO).';
        }

        if (count($this->_db_errors)) {
            die(implode('<br>', $this->_db_errors));
        }
    }


    public function query($query, $params = array()) {
        try {
            $stmt = $this->_db_connection->prepare($query);
            if ($stmt->execute($params) !== false) {
                if  (preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $query)) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } elseif(preg_match("/^(" . implode("|", array("delete", "insert", "update", "create")) . ") /i", $query)) {
                    return $stmt->rowCount();
                }
            }
        } catch (PDOException $e) {
            $this->_db_errors[] = 'Error executing query (using PDO).';
        }
    }


    public function exists($table) {
        try {
            $result = $this->query("SELECT * FROM $table LIMIT 1");
        } catch (Exception $e) {
            $result = array();
        }

        return (count($result)) ? true : false;
    }


    public function truncate($table) {
        $query = "TRUNCATE TABLE $table";
        return $this->query($query);
    }


    public function create($table, $columns = array(), $if_not_exists = true) {
        $query = "CREATE TABLE " . ($if_not_exists ? "IF NOT EXISTS " : "") . $table . " (" . implode(", ", $columns) . ")";
        return $this->query($query);
    }


    public function drop($table) {
        $query = "DROP TABLE IF EXISTS " . $table;
        return $this->query($query);
    }


    public function close() {
        $this->_db_connection = null;
    }

}
