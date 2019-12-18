<?php

namespace System\model;

use System\Connection;

class Model extends Connection {

    public $db;

    public function __construct(){
        $this->db = Connection::getInstance()->getConnection();
    }

    public function all()
    {
        $tableName = lcfirst(get_class($this));
        try {

            $result = [];
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
            $result = [];
            $sql    = "SELECT * FROM ".$tableName.'s';
            $data   = $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}