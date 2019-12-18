<?php

namespace System\model;

use System\Connection;

class Model extends Connection {

    public $db;
    private $tableName;

    public function __construct(){
        $this->db = Connection::getInstance()->getConnection();
        $this->tableName = lcfirst(get_class($this)).'s';
    }

    public function all()
    {
        try {
            $sql    = "SELECT * FROM ".$this->tableName;
            return  $this->db->query($sql)->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get($where = [])
    {
        try {
            $where_str = '';
            if (!empty($where)) {
                $where_str .= "WHERE";
                foreach ($where as $key => $val ) {
                    $where_str .= " $key = $val ";
                }
            }
            $sql    = "SELECT * FROM {$this->tableName} ".$where_str;

            $data   = $this->db->query($sql)->fetchAll();
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql)
    {

        try {
            $sql    = "SELECT * FROM ".$this->tableName;
            return $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}