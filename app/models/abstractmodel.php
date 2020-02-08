<?php


namespace App\Models;

use App\Lib\Database;

class AbstractModel
{
    const DATA_TYPE_INT           =\PDO::PARAM_INT;
    const DATA_TYPE_STRING        =\PDO::PARAM_STR;
    const DATA_TYPE_BOOLEAN       =\PDO::PARAM_BOOL;
    const DATA_TYPE_FLOAT         =4;
    const DEFAULT_USER_AVATAR     ='images/default_user.png';

    private function BindParams($Table_Schema){
        $SQLPART=" SET ";
        foreach ($Table_Schema as $key =>$value){
            $SQLPART.=$key."=:$key,";
        }
        return trim($SQLPART,',');
    }

    private function PrepareValues($Table_Schema,$Stmt){
        foreach ($Table_Schema as $key =>$value){
            $Stmt->bindValue(":$key",$this->$key,$value);
        }
        return $Stmt;
    }

    private function Update(){
        $PK=static::$PRIMARY_KEY;
        $SQL='UPDATE '.static::$TABLE_NAME.$this->BindParams(static::$TABLE_SCHEMA)." WHERE ".static::$PRIMARY_KEY;
        $SQL.="=".$this->$PK;
        return  $SQL;
    }

    private function Create(){
        $SQL='INSERT INTO '.static::$TABLE_NAME.$this->BindParams(static::$TABLE_SCHEMA);
        return  $SQL;

    }

    public function Save(){
        $PK=static::$PRIMARY_KEY;
        $SQL=(($this->$PK)==NULL)?$this->Create():$this->Update();
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $Stmt=$this->PrepareValues(static::$TABLE_SCHEMA,$Stmt);
        try{
            if(($this->$PK)==NULL){
                $is_exist=$this->CheckRecordExist(0);
            }else{
                $is_exist=$this->CheckRecordExist(1);
            }
            echo $is_exist.'ssssssssss';
            if ($is_exist===true){
                return array(
                    'Msg'        =>'Record Already Exist',
                    'Type'       =>'danger',
                    'Status'     =>false
                );
            }else{
                $result=$Stmt->execute();
                if ($result===true){
                    return array(
                        'Msg'        =>'Operation Done Successfully',
                        'Type'       =>'success',
                        'ID'       =>$Handler->lastInsertId(),
                        'Status'     =>true
                    );
                }
            }

        }catch (\PDOException $e){
            return array(
                'Msg'        =>'Invalid  Operation May Be Data Already Exist',
                'Type'       =>'danger',
                'Status'     =>false
            );
        }
    }

    public function CheckRecordExist($count){

        $unique=static::$UNIQUE_KEY;
        if ($unique==null){
            return false;
        }
        $unique=$this->$unique;
        $SQL="SELECT * FROM ".static::$TABLE_NAME." WHERE ".static::$UNIQUE_KEY."='$unique'";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $Stmt->execute();
        if (($Stmt->rowCount())>$count){
            //user found
            return true;
        }else{
            // user not found
            return false;
        }
    }

    public function getByPk($PK){
        $SQL="SELECT * FROM ".static::$TABLE_NAME." WHERE ".static::$PRIMARY_KEY."=$PK";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $Stmt->execute();
        if ($Stmt->rowCount()>0){
            return array(
                'Msg'        =>'Existing Record',
                'Type'       =>'success',
                'Data'       =>$Stmt->fetchAll(\PDO::FETCH_CLASS,__CLASS__),
                'Status'     =>true
            );
        }else{
            return array(
                'Msg'        =>'This Record Not Found',
                'Type'       =>'danger',
                'Data'       =>null,
                'Status'     =>false
            );
        }
    }

    public function getAll(){
        $SQL="SELECT * FROM ".static::$TABLE_NAME;
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $result=$Stmt->execute();
        if ($result===true){
            return $Stmt->fetchAll(\PDO::FETCH_CLASS,__CLASS__);
        }
    }

    public function Remove($id){
        $SQL="DELETE FROM ".static::$TABLE_NAME." WHERE ".static::$PRIMARY_KEY."=$id";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $result=$Stmt->execute();
        if ($result===true){
            return array(
                'Msg'        =>'Deleted Successfully',
                'Type'       =>'success',
                'Status'     =>true
            );
        }else{
            return array(
                'Msg'        =>'Invalid  Operation Or May Be Element Not Exist',
                'Type'       =>'danger',
                'Status'     =>false
            );
        }
    }
}



/*
 * Get By Pk
 * Get By Unique Key
 * Get All
 * Insert
 * Delete
 * Update
 * */