<?php


namespace App\Lib;


trait Helper
{

    public static function  Redirect($path){
        header('Location: '.$path);
    }

}