<?php

class route{

    public function __construct(){

        if(empty($_SERVER['REDIRECT_URL'])) {

            $url       = substr($_SERVER['REQUEST_URI'], 1);
            $url_array = explode("/", $url);

            if($url_array[0] == ''){
                $this->use_controller([CONFIG['default_controller']]);
            }else{
                $step = 0;
                $info = $this->get_urls_array($step,$url_array);
                $this->use_controller($info);
            }

        }else{

            $url       = substr($_SERVER['REDIRECT_URL'], 1);
            $base_url  = explode("/", CONFIG['base_url']);
            $url_array = explode("/", $url);

            if(!empty($base_url[1])){
                $step = $base_url[1] == $url_array[0]  ? 1 : 0;
            }else{
                $step = 0;
            }

            $info = $this->get_urls_array($step,$url_array);
            $this->use_controller($info);

        }

    }

    function use_controller($url_array)
    {
        $controller_name   = $url_array[0] ;

        if(file_exists("./".APPLICATION.'controllers/'.$controller_name.'.php')){

            require "./".APPLICATION.'controllers/'.$controller_name.'.php';
            $active_controller = new $controller_name;

            if(empty($url_array[1])){
                $method = "index";
                $this->call_controller_function($method,$active_controller);
            } else if(!empty($url_array[1]) && empty($url_array[2])){
                $method = $url_array[1];
                $this->call_controller_function($method,$active_controller);
            } else if(!empty($url_array[2])){
                $method = $url_array[1];
                $params = $this->get_params($url_array);
                $this->call_controller_function($method,$active_controller,$params);
            }

        }else{
            $this->redirect(CONFIG['base_full_url'].'404.php');
        }
    }



    public function call_controller_function($method, $active_controller, $params = [])
    {
        if(method_exists($active_controller, $method) == true)
        {
            if (empty($params)) {
                call_user_func(array($active_controller, $method));
                exit();
            } else {
                call_user_func_array(array($active_controller, $method),$params);
                exit();
            }

        }

        $this->redirect(CONFIG['base_full_url'].'404.php');
    }

    public function get_params($url_array)
    {
        $params = [];

        for ($i=2; $i < count($url_array) ; $i++) {
            array_push($params, $url_array[$i]);
        }

        return      ;
    }





    public function redirect($url)
    {
        header('location:'.$url);
    }

    public function get_urls_array($step,$url_array)
    {
        $info = [];

        for($i=$step; $i<count($url_array); $i++){
            array_push($info, $url_array[$i]);
        }

        return $info;
    }

}

new route();