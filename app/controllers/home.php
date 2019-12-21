<?php

use System\Controller;
use System\DB;
use System\View;


class Home extends Controller
{
    public function test()
    {
        echo "Test"."<br>" ;
    }

    public function index()
    {

//        echo shell_exec("ping google.com");;


//      MODEL QUERY
//      $User = $this->loadModel("User");
//      $select_data = $User->all();
//


//        SELECT
//        $db_user = DB::sql()
//                   ->select('*')
//                   ->from("test")
//                   ->where("id", "=", 72)
//                   ->orWhere("id", "=", 73)
//                   ->orderBy('id','DESC');
//
//        $select_data  = $db_user->get();
//
//        echo "<pre>";
//        print_r($select_data);die;
//


//        INSERT
//        $insert_user   = DB::sql()
//                             ->insert('test', ['name','email','status'],['vazgen','tyom465@mail.ru',46])
//                             ->run();
//        $insert_id     = $insert_user->insertId();
//        $insert_status = $insert_user->insertStatus();
//
//
//        print_r($insert_id);
//        echo "<br>";
//        print_r($insert_status);
//        echo "<br>";
//        echo "<hr>";



//        UPDATE
//        $update_user  = DB::sql()
//                            ->update('test', ['name' => 'u','email' =>'update@gmail.com','status' => 3])
//                            ->where("id", "=", "72")
//                            ->orWhere("id", "=", "74")
//                            ->run();
//
//        $update_status = $update_user->updateStatus();
//
//        print_r($update_status);die;



      View::render('home',array('title' =>"Home page",'name' => "tyom"));
//      $this->renderView('home',array('title' => "home",'name' => "tyom"));
    }

}

