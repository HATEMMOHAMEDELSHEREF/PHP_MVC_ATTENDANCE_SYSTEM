<?php


namespace App\Lib;

class Services
{
    public static  function getAll($tablename,$colums="*",$conditions=""){
        $Handler=Database::Connection();
        $SQL="SELECT ".$colums." FROM ".$tablename.' '.$conditions;
        $Stmt=$Handler->prepare($SQL);
        $result=$Stmt->execute();
        $data=$Stmt->fetchAll(\PDO::FETCH_OBJ);
        if ($result===true){
            return array(
                'Msg'        =>'Data Founded',
                'Data'       =>$data,
                'Type'       =>'success',
                'Status'     =>true
            );
        }else{
            return array(
                'Msg'        =>'No Data Found',
                'Type'       =>'danger',
                'Status'     =>false
            );
        }
    }

    public static function Remove($tablename,$cond=""){
        $Handler=Database::Connection();
        $SQL="DELETE FROM ".$tablename." WHERE ".$cond;
        $Stmt=$Handler->prepare($SQL);
        $result=$Stmt->execute();
        if ($result===true){
            return array(
                'Msg'        =>'Success Operation',
                'Type'       =>'success',
                'Status'     =>true
            );
        }else{
            return array(
                'Msg'        =>'Failed Operation',
                'Type'       =>'danger',
                'Status'     =>false
            );
        }
    }


}