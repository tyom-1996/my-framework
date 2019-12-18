<?php

use System\controllers\core;

class Home extends core
{
    public function index()
    {
        $User = $this->load_model("User");
//      $User->all();
//        $curent_user = $User->get(['id' => 2]);
        $curent_user = $User->all();

        echo "<pre>";
        print_r($curent_user);

      $this->load_page('home',array('title' => "home",'name' => "tyom"));
    }

}