<?php

class sf_controller{

    public function __construct(){

        if(empty($_SERVER['REDIRECT_URL'])) {

            $url       = substr($_SERVER['REQUEST_URI'], 1);
            $url_array = explode("/", $url);


            if($url_array[0] == $GLOBALS['base_url']){

                $this->use_controller("defaultController");

            }else{

                $info=[];

                for($i=0; $i<count($url_array); $i++){
                    array_push($info, $url_array[$i]);
                }

                $this->use_controller($info);

            }


        }else{

            $url       = $_SERVER['REDIRECT_URL'];
            $url       = substr($url, 1);
            $base_url  = explode("/", base_url());
            $url_array = explode("/", $url);


            if(!empty($base_url[1])){

                if($base_url[1]==$url_array[0]){

                    $info=[];
                    for($i=1; $i<count($url_array); $i++){
                        array_push($info, $url_array[$i]);
                    }

                    $this->use_controller($info);
                }else{
                    $info=[];
                    for($i=0; $i<count($url_array); $i++){
                        array_push($info, $url_array[$i]);
                    }
                    $this->use_controller($info);
                }
            }else{
                $info=[];
                for($i=0; $i<count($url_array); $i++){
                    array_push($info, $url_array[$i]);
                }
                $this->use_controller($info);
            }

        }

    }

    function use_controller($url_array){


        if(file_exists("./".APPLICATION.'controllers/'.$url_array[0].'.php')){

            require "./".APPLICATION.'controllers/'.$url_array[0].'.php';

            $controller_name   = $url_array[0];
            $active_controller = new $controller_name;


            if(empty($url_array[1])){

                $method = "index";

                if(method_exists($active_controller, $method)==true){
                    call_user_func(array($active_controller,$method));
                    exit();
                }else{
                    header('location:'.base_url_super().'404.php');

                }

            }else if(!empty($url_array[1])&&empty($url_array[2])){
                $method = $url_array[1];
                if(method_exists($active_controller, $method)==true){
                    call_user_func(array($active_controller,$method));
                }
                else{
                    header('location:'.base_url_super().'404.php');
                }

            }else if(!empty($url_array[2])){

                $method = $url_array[1];
                $params = [];



                for ($i=2; $i < count($url_array) ; $i++) {
                    array_push($params, $url_array[$i]);
                }


                if(method_exists($active_controller, $method) == true){
                    call_user_func_array(array($active_controller,$method), $params);
                    exit();
                }

            }

        }else{
            header('location:'.base_url_super().'404.php');

        }
    }
}
new sf_controller();