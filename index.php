<?php

require 'vendor/autoload.php';

$system_path        = 'system';
$application_folder = 'application';
$view_folder        = 'application/views';

define('BASEPATH', $system_path.'/');
define('APPLICATION', $application_folder.'/');
define('VIEW', $view_folder.'/');

require_once BASEPATH . 'artframework.php';