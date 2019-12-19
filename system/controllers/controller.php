<?php
namespace System\controllers;

Class controller{

    function load_model($model)
    {
        include_once "./".APPLICATION.'models/'.$model.'.php';
        return new $model;
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