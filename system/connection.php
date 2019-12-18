<?php

namespace System;

class Connection {

    private $_connection;
    private static $_instance;

    private $_host;
    private $_username;
    private $_password;
    private $_database;


    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $config = include_once './config/config.php';

        $this->_host     = $config['database']['DB_HOST'];
        $this->_username = $config['database']['DB_USERNAME'];
        $this->_password = $config['database']['DB_PASSWORD'];
        $this->_database = $config['database']['DB_DATABASE'];

        try {
            $this->_connection  = new \PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function __clone(){}

    public function getConnection()
    {
        return $this->_connection;
    }
}
