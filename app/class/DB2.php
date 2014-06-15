<?php

class DB2 {

    private static $_instance = null;
    private $_db_host = null;
    private $_db_user = null;
    private $_db_password = null;
    private $_db_name = null;
    private $_db_wrapper = null;
    private $_db_connection = null;
    private $_db_connection_error = false;


    public static function table() {
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
        $this->_db_wrapper = Config::get('app.db_wrapper');
        $valid_db_wrappers = array('pdo', 'mysqli');

        if (!in_array($this->_db_wrapper, $valid_db_wrappers)) {
            $this->_db_wrapper = 'pdo';
        }

        $this->_connect();
    }


    private function _connect() {
        if ($this->_db_wrapper === 'pdo') {
            try {
                $this->_db_connection = new PDO('mysql:host=' . $this->_db_host . ';dbname=' . $this->_db_name, $this->_db_user, $this->_db_password);
            } catch (PDOException $e) {
                $this->_db_connection_error = true;
            }
        } elseif ($this->_db_wrapper === 'mysqli') {
            $this->_db_connection = new mysqli($this->_db_host, $this->_db_user, $this->_db_password, $this->_db_name);

            if ($this->_db_connection->connect_errno) {
                $this->_db_connection_error = true;
            }
        }
    }


    public function query($query) {
        $result = array();

        if ($this->_db_wrapper === 'pdo') {
            $query = $this->_db_connection->query($query);

            if ($query->rowCount()) {
                //return $query->fetchAll();
                while ($obj = $query->fetchObject()) {
                    $result[] = $obj;
                }
            }

            return $result;
        } elseif ($this->_db_wrapper === 'mysqli') {
            $query = $this->_db_connection->query($query);
            $result = array();

            if ($query->num_rows) {
                while ($obj = $query->fetch_object()) {
                    $result[] = $obj;
                }
            }

            return $result;
        }

        return $result;
    }


    public function close() {
        if ($this->_db_wrapper === 'pdo') {
            $this->_db_connection = null;
        } elseif ($this->_db_wrapper === 'mysqli') {
            $this->_db_connection->close();
        }
    }

}
