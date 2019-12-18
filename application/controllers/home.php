<?php

use System\controllers\core;


class Home extends core
{
    public function index()
    {
        $User = $this->load_model("User");
        $User->all();
        var_dump($User->get(['id' => 1]));

//      $this->load_page('home',array('title' => "home",'name' => "tyom"));
    }

}