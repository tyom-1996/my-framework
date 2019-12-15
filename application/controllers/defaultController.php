<?php

class defaultController {

    public function index()
    {
        echo "hello i am ".get_class()." class";die;
    }

    public function home()
    {
        echo "hello i am ".__METHOD__;die;
    }



}

