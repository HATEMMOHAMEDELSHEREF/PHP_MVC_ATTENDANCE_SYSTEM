<?php


namespace App\Lib;

class Autoloader{

    public static function autoload($className){

        $className=str_replace('App','',$className);
        //$className=str_replace('\\','/',$className);
        $className=trim($className,'\\');
        $className=strtolower($className);
        $fileName=APP_PATH.$className.'.php';
        if (file_exists($fileName)){
            require_once ($fileName);

        }

    }
}


spl_autoload_register(__NAMESPACE__.'\Autoloader::autoload');