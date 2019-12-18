<?php

namespace System\model;

use System\Connection;

class Model extends Connection {

    public $db;
    private $tableName;

    public function __construct(){
        $this->db = Connection::getInstance()->getConnection();
        $this->tableName = lcfirst(get_class($this));
        var_dump($this->tableName);
    }

    public function all()
    {
        $tableName = lcfirst(get_class($this));
        try {
            $sql    = "SELECT * FROM ".$tableName.'s';
            $data   = $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get($where)
    {
        $tableName = lcfirst(get_class($this));
        try {
            $sql    = "SELECT * FROM ".$tableName.'s';
            $data   = $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql)
    {
        $tableName = lcfirst(get_class($this));
        try {
            $sql    = "SELECT * FROM ".$tableName.'s';
            $data   = $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}