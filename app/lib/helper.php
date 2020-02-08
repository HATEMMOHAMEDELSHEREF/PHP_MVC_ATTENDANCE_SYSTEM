<?php


namespace App\Lib;


trait Helper
{

    public static function  Redirect($path){
        header('Location: '.$path);
    }

    private static function PassQoute($value){
        return str_replace('\'','\\\'',$value);
    }

    public static function FilterEmail($value){
        $value=self::PassQoute($value);
        $value=filter_var($value,FILTER_SANITIZE_EMAIL);
        if (filter_var($value,FILTER_VALIDATE_EMAIL)){
            return $value;
        }else{
            return false;
        }
    }

    public static function Filter_String($value){
        $value=self::PassQoute($value);
       if (is_string($value)){
           return filter_var($value,FILTER_SANITIZE_STRING);
       }else{
           return null;
       }
    }

    public static function Filter_Int($value){
        if (is_numeric($value)){
            return filter_var($value,FILTER_SANITIZE_NUMBER_INT);
        }
        return false;
    }

    public static function Filter_Float($value){
       if(is_numeric($value)){
           return filter_var($value,FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
       }else{
           return false;
       }
    }

    public static function Filter_Boolean($value){
        if(is_bool($value)){
            return $value;
        }else{
            return boolval(false);
        }
    }

    public static function Filter_URL($value){
        return filter_var($value,FILTER_SANITIZE_URL);
    }

    public static function FilterPhone($value){
        $value=self::PassQoute($value);
        $pattern='/^[0-9]*$/';
        if (preg_match($pattern,$value)){
            return $value;
        }else{
            return false;
        }
    }


}