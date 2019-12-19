<?php
namespace System;

use System\Connection;

class DB extends Connection
{
    public $db;
    public $query_part;
    private static $_instance_DB;
    public $action;

    public function __construct(){
        $this->db = Connection::getInstance()->getConnection();
    }

    public static function sql()
    {
        if (!self::$_instance_DB) {
            self::$_instance_DB = new self();
        }
        return self::$_instance_DB;
    }

    public function select($select_options = "*")
    {
        $this->query_part .= "SELECT " . $select_options;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function from($from_options)
    {
        $this->query_part .= " FROM " . $from_options;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function where()
    {
        $where_options = '';

        foreach (func_get_args() as $arg) {
            $where_options.="$arg ";
        }

        if($this->action == 'orWhere' || $this->action == __FUNCTION__) {
            $this->query_part .= "AND " . $where_options;
        } else{
            $this->query_part .= " WHERE " . $where_options;
        }

        $this->action = __FUNCTION__;

        return $this;
    }

    public function orWhere()
    {
        $or_where_options = '';

        foreach (func_get_args() as $arg) {
            $or_where_options.="$arg ";
        }

        if($this->action == 'where' || $this->action == __FUNCTION__) {
            $this->query_part .= "OR " . $or_where_options;
        } else{
            $this->query_part .= " WHERE " . $or_where_options;
        }

        $this->action      = __FUNCTION__;

        return $this;
    }

    public function groupBy($group_options)
    {
        $this->query_part .= " GROUP BY " . $group_options;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function orderBy($order_options,$argument)
    {
        $this->query_part .= " ORDER BY " . $order_options." ".$argument ;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function get()
    {
        $result_arr = [];
        $result     = $this->db->query($this->query_part);

        if($result->num_rows > 0 ){
            while ($r = $result->fetch_assoc()){
                $result_arr[] = $r;
            }
        }
        $this->query_part = '';

        return $result_arr ;
    }

    public function get_query()
    {
        return $this->query_part;
    }

}

