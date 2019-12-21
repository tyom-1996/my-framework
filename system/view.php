<?php

namespace System;

class View {

    public static function render($pagetoload, $data = null)
    {
        $view = APP_CONF['ROOT']."./".APP_CONF['app_path'].'views/'.$pagetoload.'.php';

        if(file_exists($view)) {

            if($data != null) {
                extract($data);
                unset($data);
            }

            include $view;

            exit();
        }

        self::redirect('/404.php');
    }

    public function redirect($url)
    {
        header('location:'.$url);
    }

}