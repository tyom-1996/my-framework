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
        $result = [];
        $sql    =  "SELECT * FROM ".$this->tableName;
        $data   =  $this->db->query($sql);

        while ($r = $data->fetch_assoc()) {
            $result[] = $r;
        }

        return $result;
    }

    public function get($where = [])
    {
        try {

            $where_str = '';
            $result    = [];

            if (!empty($where))
            {
                $where_str .= "WHERE";
                foreach ($where as $key => $val ) {
                    $where_str .= " $key = $val ";
                }
            }

            $sql  = "SELECT * FROM $this->tableName ".$where_str;
            $data =  $this->db->query($sql);

            while ($r = $data->fetch_assoc()) {
                $result[] = $r;
            }
            return  $result;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql)
    {
        $result = [];
        $data   =  $this->db->query($sql);
        while ($r = $data->fetch_assoc()) {
            $result[] = $r;
        }
        return $result;
    }


}