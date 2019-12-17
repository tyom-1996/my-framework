<?php

use System\controllers\core;

class Home extends core
{
    public function index()
    {

      $this->load_page('home',array('title' => "home",'name' => "tyom"));

    }

    public function test($a, $b)
    {
        print_r($a);
        print_r($b);
    }
}