<?php

/**
 * Name artframework;
 * Version 1.0.0
 * @var    string
 *
 */

define('SF_VERSION', '1.0.0');

$GLOBALS['base_url'] = '';

function base_url()
{
    return  empty($GLOBALS['base_url']) ? $_SERVER['HTTP_HOST'].'/' : $_SERVER['HTTP_HOST'].'/'.$GLOBALS['base_url'].'/' ;
}

function base_url_super()
{
    return "http://".base_url();
}

require_once  BASEPATH.'controllers/controller.php';