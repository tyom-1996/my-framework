<?php
namespace System;

use System\Connection;

class DB extends Connection
{
    public $db;

    public $query_part;

    private static $_instance_DB;

    // for where and orWhere methods

    public $action;

    // for select and insert and update;

    public $action_part;


    private static $insertId;

    private static $insertStatus;

    private static $updateStatus;

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
        $this->action = $this->action_part = __FUNCTION__;

        return $this;
    }


//    Insert methods

    public function insert($table_name,$fields,$values)
    {
        $this->query_part .= "INSERT INTO " . $table_name." (";
        $this->query_part .= $this->createFields($fields);
        $this->query_part .= $this->createValues($values);
        $this->action      = $this->action_part = __FUNCTION__;

        return $this;
    }


//    ------------Insert methods START----------------

    public function createFields($fields)
    {
        $last_fields = $fields[count($fields)-1];
        $query_part  = '';

        foreach ($fields as $arg)
        {
            if($last_fields != $arg)
            {
                $arg .= ", ";
            }
            $query_part .= "$arg";
        }
        return $query_part.") VALUES(";
    }


    public function createValues($values) {

        $last_value_pos = count($values)-1;
        $query_part  = "";

        foreach ($values as $key =>$val) {

            $val_ = gettype($val) == 'string' ? "'$val'" : "$val";

            if($last_value_pos != $key) {
                $val_ .= ", ";
            }

            $query_part .= "$val_";

        }

        return $query_part .=")";
    }

//    ------------Insert methods END----------------



//    ------------Update methods START----------------

    public function update($table = '',$arguments) {

        $last_value_pos = count($arguments)-1;
        $index          = 0;
        $this->query_part .= "UPDATE ".$table." SET ";

        foreach ($arguments as $key =>$val) {

            $val_ = gettype($val) == 'string' ? "'$val'" : "$val";

            if($last_value_pos != $index) {
                $val_ .= ", ";
            }
            $this->query_part .= $key." = "."$val_ ";
            $index++;
        }

        $this->action = $this->action_part = __FUNCTION__;

        return $this;
    }


//    ------------Update methods END----------------

    public function run() {

        try{
            $status           = $this->db->query($this->query_part);
            $this->query_part = "";

            if ($status) {
                if($this->action_part == 'insert') {
                    $this->setInsertAnswerOptions($this->db->insert_id,$status);
                } elseif ($this->action_part == 'update') {
                    $this->setUpdateAnswerOptions($status);
                }
                return $this;
            }

            return false;

        } catch(Exception $e) {
            $error = $e->getMessage();
            echo $error;die;
        }
    }


    public function setInsertAnswerOptions($insert_id,$insertStatus) {
        self::$insertId = $insert_id;
        self::$insertStatus = $insertStatus;
    }


    public function setUpdateAnswerOptions($updateStatus) {
        self::$updateStatus = $updateStatus;
    }


    public function insertId() {
        if($this->action_part == 'insert') {
            return self::$insertId;
        }
    }

    public function insertStatus()
    {
        if($this->action_part == 'insert') {
            return self::$insertStatus;
        }
    }

    public function updateStatus() {
        if($this->action_part == 'update') {
            return self::$updateStatus;
        }
    }

    public function from($from_options) {

        $this->query_part .= " FROM " . $from_options;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function where() {

        $where_options = '';

        foreach (func_get_args() as $arg) {
            $where_options .= "$arg ";
        }

        if($this->action == 'orWhere' || $this->action == __FUNCTION__) {
            $this->query_part .= "AND ".$where_options;
        } else{
            $this->query_part .= " WHERE ".$where_options;
        }

        $this->action = __FUNCTION__;

        return $this;
    }

    public function orWhere() {

        $or_where_options = '';

        foreach (func_get_args() as $arg) {
            $or_where_options.="$arg ";
        }

        if($this->action == 'where' || $this->action == __FUNCTION__) {
            $this->query_part .= "OR " . $or_where_options;
        } else{
            $this->query_part .= " WHERE " . $or_where_options;
        }

        $this->action = __FUNCTION__;

        return $this;
    }

    public function groupBy($group_options) {
        $this->query_part .= " GROUP BY ".$group_options;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function orderBy($order_options,$argument) {
        $this->query_part .= " ORDER BY ".$order_options." ".$argument ;
        $this->action      = __FUNCTION__;

        return $this;
    }

    public function get() {
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

}




