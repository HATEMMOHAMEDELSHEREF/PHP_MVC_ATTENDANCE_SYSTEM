<?php

defined('DS')?NULL:define('DS',DIRECTORY_SEPARATOR);

define('APP_PATH',realpath(dirname(__FILE__)).DS.'..'.DS);

define('LIB_PATH',APP_PATH.'lib'.DS);

define('CONTROLLER_PATH',APP_PATH.'controllers'.DS);

define('MODEL_PATH',APP_PATH.'models'.DS);

define('VIEW_PATH',APP_PATH.'views'.DS);

define('TEMPLATE_PATH',APP_PATH.'template'.DS);

define('LANGUAGE_PATH',APP_PATH.'language'.DS);

define('CSS','/css/');
define('JS','/js/');

defined('HOSTNAME')?NULL:define('HOSTNAME','localhost');
defined('USERNAME')?NULL:define('USERNAME','root');
defined('PASSWORD')?NULL:define('PASSWORD','');
defined('DATABASENAME')?NULL:define('DATABASENAME','mufix');

