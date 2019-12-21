<?php

use System\Controller;
use System\DB;

class mainController extends Controller {

    public function index()
    {
        echo "hello i am  def";
    }

    public function home()
    {
        echo "hello i am ".__METHOD__;die;
    }



}

