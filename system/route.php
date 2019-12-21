<?php

namespace System;

class route{

    public $url_array;
    public $controllerName;
    public $methodName;
    public $args;


    public function __construct()
    {

        $this->url_array       = $this->parseUrl();
        $this->controllerName  = $this->getControllerName($this->url_array);
        $this->methodName      = $this->getControllerMethod($this->url_array);
        $this->args            = $this->getArguments($this->url_array);
    }


    public function run(){



        if($this->controllerName == '404.php') {
            include APP_CONF['ROOT'].'/404.php';
            exit();
        }

        $controller_path = APP_CONF['ROOT']."/".APP_CONF['app_path'].'controllers/'.$this->controllerName.'.php';

        if(file_exists($controller_path)) {

            require $controller_path;

            $controller = new $this->controllerName;

            if(!empty($this->args)) {

                call_user_func_array(array($controller, $this->methodName), $this->args);

            } else {

                call_user_func(array($controller, $this->methodName));

            }

        } else {

            $this->redirect('/404.php');
        }

    }


    public function getArguments($arg)
    {
        $arguments = [];
        $count     = count($arg);

        for ($i=2; $i < $count ; $i++) {
            array_push($arguments, $arg[$i]);
        }

        return $arguments;
    }

    public function getControllerName($controller)
    {
        return isset($controller[0]) && !empty($controller[0]) ? $controller[0] : APP_CONF['default_controller'];
    }

    public function getControllerMethod($method)
    {
        return isset($method[1]) && !empty($method[1]) ? $method[1] : 'index';
    }

    public function parseUrl()
    {
        if(isset($_GET['route']))
        {
            $url     = explode('/', filter_var(rtrim($_GET['route'], '/'), FILTER_SANITIZE_URL));
            $actions = [];
            $new_url =  array_filter($url, function($element) {
                return !empty($element);
            });

            foreach ($new_url as $key) {
                $actions[] = $key;
            }
            return $actions;
        }

        return [];
    }


    public function redirect($url)
    {
        header('location:'.$url);
    }

}

