<?php

use System\controllers\core;

class Home extends core
{
    public function index()
    {
        $User = $this->load_model("User");
//      $User->all();
        $curent_user = $User->get(['is_admin' => 0]);
//        $curent_user = $User->sql()
//                       ->select()
//                       ->where()

        echo "<pre>";
        print_r($curent_user);

      $this->load_page('home',array('title' => "home",'name' => "tyom"));
    }

}



//s