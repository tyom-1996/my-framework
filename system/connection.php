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
        $this->_host       = $GLOBALS['config']['database']['DB_HOST'];
        $this->_username   = $GLOBALS['config']['database']['DB_USERNAME'];
        $this->_password   = $GLOBALS['config']['database']['DB_PASSWORD'];
        $this->_database   = $GLOBALS['config']['database']['DB_DATABASE'];

        $this->_connection = new\ mysqli($this->_host, $this->_username, $this->_password, $this->_database);

        if(mysqli_connect_errno()) {
            echo "Connection Failed: " . mysqli_connect_errno();
            exit();
        }
    }

    private function __clone(){}

    public function getConnection()
    {
        return $this->_connection;
    }



}


