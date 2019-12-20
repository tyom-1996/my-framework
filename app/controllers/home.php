<?php

use System\controller\controller;
use System\DB;

class Home extends controller
{
    public function index()
    {
//      MODEL QUERY
//      $User = $this->load_model("User");
//      $model_user = $User->all();

//        DB QUERYES

//        SELECT
//        $db_user = DB::sql()
//                   ->select('*')
//                   ->from("users")
//                   ->where("id", "=", 1)
//                   ->orWhere("id", "=", 2)
//                   ->orderBy('id','DESC');

//        $select_query = $db_user->get_query();
//        $select_data  = $db_user->get();
//
//        print_r($select_query);
//        print_r($select_data);die;



//        INSERT
        $insert_user   = DB::sql()->insert('users', ['name','is_admin','email'],['vazgen',46,'tyom46@mail.ru']);
        $insert_query  = $insert_user->get_query();
        $insert_status = $insert_user->run();
        print_r($insert_status);
        print_r($insert_query);


//        UPDATE
//        $update_user  = DB::sql()
//                            ->update('users', ['name' => 'artyom','is_admin' => 3,'email' =>'update@gmail.com'])
//                            ->where("id", "=", "23");
//
//        $update_query  = $update_user->get_query();
//        $update_status = $update_user->run();
//
//        print_r($update_query);
//        echo "<br>";
//        print_r($update_status);die;


      $this->load_page('home',array('title' => "home",'name' => "tyom"));
    }

}

