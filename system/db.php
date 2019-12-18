<?php

use System\Connection;


class DB
{

    private static $instance = NULL;

    public static function sql()
    {
        self::$instance = new self();
        return self::$instance;
    }

    // These methods set the query clauses
    // Use * as default
    public function select(string $select_options = "*")
    {

        $query_part = "SELECT " . $select_options;
        $this->select = $query_part;
        return $this;
    }

    // From table in DB
    public function from(string $from_options)
    {

        $query_part = "FROM " . $from_options;

        $this->from = $query_part;
        return $this;
    }

    // These methods set the query clauses
    public function where(string $where_options)
    {

        $query_part = "WHERE " . $where_options;
        $this->where = $query_part;
        return $this;
    }

    // GroupBy
    public function groupBy(string $group_options)
    {

        $query_part = "groupBy " . $group_options;
        $this->groupBy = $query_part;
        return $this;
    }


    public function get()
    {
        $array = (array)$this;
        $string = implode(" ", $array);

        return $string;
    }

}


//
/// Use class DB
//$query = DB::sql()
//    ->select()
//    ->from("CustomerInfo")
//    ->where("customer_id > 300")
//    ->get();
//
//// Echo result
//echo $query;