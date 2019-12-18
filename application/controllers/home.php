<?php

use System\controllers\core;


class Home extends core
{
    public function index()
    {
        $User = $this->load_model("User");

//        $User->test();
        $User->all();
        $User->get(['id' => 5]);

//      $this->load_page('home',array('title' => "home",'name' => "tyom"));
    }

}