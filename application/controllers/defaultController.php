<?php

class defaultController {

    public function index()
    {
        echo "hello i am  def";
    }

    public function home()
    {
        echo "hello i am ".__METHOD__;die;
    }



}

