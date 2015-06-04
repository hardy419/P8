<?php 
if(version_compare(PHP_VERSION, '5.3.0','<'))die('require PHP > 5.3.0 !');
$_GET['m']='Admin';
define('SITE_PATH','/p8/');
define('APP_PATH','./Application/');
define('APP_DEBUG',true);
require './ThinkPHP/ThinkPHP.php';
?>