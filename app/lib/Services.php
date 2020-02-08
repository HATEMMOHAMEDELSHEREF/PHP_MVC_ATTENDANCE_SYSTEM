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

    public static function Merge($table,$schema,$data){
        $Handler=Database::Connection();
        $SQL="INSERT INTO ".$table." SET ";
        foreach($schema as $columName =>$type){
            $SQL.=$columName."=:".$columName.",";
        }
        $SQL=trim($SQL,',');
        $PARAMS=array();
        foreach($data as $columName =>$value){
            $x=":$columName";

        }


    }
}