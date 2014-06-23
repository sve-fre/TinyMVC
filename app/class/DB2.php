<?php

class DB2 {

    private static $_instance = null;
    private $_db_host = null;
    private $_db_user = null;
    private $_db_password = null;
    private $_db_name = null;
    private $_db_wrapper = null;
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
        $this->_db_wrapper = Config::get('app.db_wrapper');
        $valid_db_wrappers = array('pdo', 'mysqli');

        if (!in_array($this->_db_wrapper, $valid_db_wrappers)) {
            $this->_db_wrapper = 'pdo';
        }

        $this->_connect();
    }


    public function query($query, $params = array()) {
        if ($this->_db_wrapper === 'pdo') {
            try {
                $stmt = $this->_db_connection->prepare($query);
                if ($stmt->execute($params) !== false) {
                    if  (preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $query)) {
                            return $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } elseif(preg_match("/^(" . implode("|", array("delete", "insert", "update")) . ") /i", $query)) {
                            return $stmt->rowCount();
                        }
                }
            } catch (PDOException $e) {

            }
        } elseif ($this->_db_wrapper === 'mysqli') {
            die('No mysqli support for DB2::query() yet.');
        }
    }


    private function _connect() {
        if ($this->_db_wrapper === 'pdo') {
            try {
                $this->_db_connection = new PDO('mysql:host=' . $this->_db_host . ';dbname=' . $this->_db_name, $this->_db_user, $this->_db_password);
            } catch (PDOException $e) {
                $this->_db_errors[] = 'Could not connect to database (using PDO).';
            }
        } elseif ($this->_db_wrapper === 'mysqli') {
            $this->_db_connection = new mysqli($this->_db_host, $this->_db_user, $this->_db_password, $this->_db_name);

            if ($this->_db_connection->connect_errno) {
                $this->_db_errors[] = 'Could not connect to database (using MySQLi).';
            }
        }

        if (count($this->_db_errors)) {
            die(implode('<br>', $this->_db_errors));
        }
    }


    public function select($select) {
        $result = array();
        $query = $this->_db_connection->query($select);

        if ($this->_db_wrapper === 'pdo' && $query->rowCount()) {
            while ($obj = $query->fetchObject()) {
                $result[] = $obj;
            }
        } elseif ($this->_db_wrapper === 'mysqli' && $query->num_rows) {
            while ($obj = $query->fetch_object()) {
                $result[] = $obj;
            }
        }

        return $result;
    }


    public function selectRow($select) {
        $result = array();
        $query = $this->_db_connection->query($select);

        if ($this->_db_wrapper === 'pdo' && $query->rowCount()) {
            while ($obj = $query->fetchObject()) {
                $result[] = $obj;
            }
        } elseif ($this->_db_wrapper === 'mysqli' && $query->num_rows) {
            while ($obj = $query->fetch_object()) {
                $result[] = $obj;
            }
        }

        return array_shift($result);
    }


    public function close() {
        if ($this->_db_wrapper === 'pdo') {
            $this->_db_connection = null;
        } elseif ($this->_db_wrapper === 'mysqli') {
            $this->_db_connection->close();
        }
    }

}
