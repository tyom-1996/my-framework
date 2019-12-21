<?php
session_start();

/**
 * LedaPHP - A PHP MVC Framework
 *
 * @package  Leda
 * @author   Artyom Hakobjanyan
 */

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

ini_set('display_errors', 1);

$route = new System\route();
$route->run();



