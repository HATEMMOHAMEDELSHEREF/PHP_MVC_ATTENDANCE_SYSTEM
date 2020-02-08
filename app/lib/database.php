<?php


namespace App\Lib;


class Database
{

    private static $_HOSTNAME=HOSTNAME;
    private static $_USERNAME=USERNAME;
    private static $_PASSWORD=PASSWORD;
    private static $_DATABASENAME=DATABASENAME;

    public static function Connection(){
        $DSN="mysql://hostname=".static::$_HOSTNAME;
        $DSN.=";dbname=".static::$_DATABASENAME;
        $OPTIONS=array(
            \PDO::ATTR_ERRMODE              =>\PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE   =>\PDO::FETCH_CLASS,
            \PDO::MYSQL_ATTR_INIT_COMMAND   =>"SET NAMES UTF8"
        );
        $_CONNECTION_HANDLER=new \PDO($DSN,static::$_USERNAME,static::$_PASSWORD,$OPTIONS);
        return $_CONNECTION_HANDLER;
    }
}