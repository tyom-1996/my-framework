<?php
namespace System\controllers;

Class core{

    public $models;

    function __construct()
    {
        $this->load_model();
    }

    function load_model()
    {
        $model = [];

        foreach (glob("./".APPLICATION.'models/*.php') as $filename) {

            include_once $filename;

            $new_name  = explode("/", $filename);
            $new_name  = $new_name[3];
            $new_names = substr($new_name, 0, -4);
            $new_name  = new $new_names;
            $model     = array($new_names => $new_name);

            array_push($model, (object)$new_name);

        }

        $this->model=(object)$model;
    }

    function load_page($pagetoload, $data = null)
    {
        if(file_exists("./".APPLICATION.'views/'.$pagetoload.'.php'))
        {
            if($data != null){
                extract($data);
                unset($data);
            }

            include "./".APPLICATION.'views/'.$pagetoload.'.php';
            exit();
        }

        $this->redirect('/404.php');
    }

    public function redirect($url)
    {
        header('location:'.$url);
    }

}