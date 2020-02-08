<?php


namespace App;
session_start();
use App\Lib\Template;
define('DS',DIRECTORY_SEPARATOR);

require_once "..".DS."app".DS.'config'.DS.'appconfig.php';
$RESOURCES=require_once '..'.DS.'app'.DS.'config'.DS.'tempconfig.php';
require_once '..'.DS.'app'.DS.'lib'.DS.'autoloader.php';



//$Template=new  Lib\Template($RESOURCES);
$Startup=new Lib\Brain(new  Lib\Template($RESOURCES));
$Startup->_dispath();