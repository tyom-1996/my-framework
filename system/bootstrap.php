<?php
session_start();

define('CONFIG', include_once './application/config/config.php');

define('BASEPATH', 'system/');
define('APPLICATION', "application/");
define('VIEW','application/views/');


require_once  BASEPATH.'route.php';

