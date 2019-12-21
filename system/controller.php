<?php

namespace System;

use System\database\Connection;

Class Controller{

    function load_model($model)
    {
        include_once APP_CONF['ROOT']."./".APP_CONF['app_path'].'models/'.$model.'.php';
        return new $model;
    }

    function load_page($pagetoload, $data = null)
    {
        if(file_exists("./".APP_CONF['app_path'].'views/'.$pagetoload.'.php'))
        {
            if($data != null)
            {
                extract($data);
                unset($data);
            }

            include "./".APP_CONF['app_path'].'views/'.$pagetoload.'.php';
            exit();
        }

        $this->redirect('/404.php');
    }

    public function redirect($url)
    {
        header('location:'.$url);
    }

}