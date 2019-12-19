<?php

use System\controller\controller;
use System\DB;

class Home extends controller
{
    public function index()
    {
//      $User = $this->load_model("User");
//      $model_user = $User->all();
        $db_user    = DB::sql()
                      ->select('*')
                      ->from("users")
                      ->where("id", "=", 1)
                      ->orWhere("id", "=", 2)
                      ->orderBy('id','DESC');

//                      ->get();

        echo "<pre>";

        print_r($db_user->get_query());
        echo "<br>";
        print_r($db_user->get());die;

      $this->load_page('home',array('title' => "home",'name' => "tyom","user_data" => $db_user));
    }

}

