<?php
session_start();

$GLOBALS['base_url'] = '';

$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';

define('BASEPATH', 'system/');
define('APPLICATION', "application/");
define('VIEW','application/views/');
define('BASE_URL',empty($GLOBALS['base_url']) ? $_SERVER['HTTP_HOST'].'/' : $_SERVER['HTTP_HOST'].'/'.$GLOBALS['base_url'].'/');
define('BASE_URL_SUPER',empty($GLOBALS['base_url']) ? $protocol.$_SERVER['HTTP_HOST'].'/' : $protocol.$_SERVER['HTTP_HOST'].'/'.$GLOBALS['base_url'].'/');

require_once  BASEPATH.'route.php';

