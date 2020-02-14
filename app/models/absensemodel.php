<?php


namespace App\Models;


use App\Lib\Database;

class AbsenseModel extends AbstractModel
{
    public static $TABLE_NAME='att_absense';
    public static $PRIMARY_KEY='absense_id';
    public static $UNIQUE_KEY=null;

    public static $TABLE_SCHEMA=array(
        'absense_session_id'=>self::DATA_TYPE_INT,
        'absense_student_id'=>self::DATA_TYPE_INT,
        'absense_date'=>self::DATA_TYPE_STRING
    );

    public $absense_id;
    public $absense_session_id;
    public $absense_student_id;
    public $absense_date;
    public $absense_status;

    public static function getOpenedSession($instructor_id){
        $SQL="SELECT * FROM att_session WHERE ((session_status in ('pending','running')) and session_instructor_id=".$instructor_id.")";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $re=$Stmt->execute();
        if ($re===true){
            if ($Stmt->rowCount()>0){
                $Result=array(
                    'Msg'=>'Data Founded',
                    'Type'=>'success',
                    'Data'=>$Stmt->fetch(\PDO::FETCH_OBJ),
                    'Status'=>true
                );
                return $Result;
            }else{
                $Result=array(
                    'Msg'=>'No Opened Session Founded',
                    'Type'=>'danger',
                    'Status'=>false
                );
                return $Result;
            }
        }else{
            $Result=array(
                'Msg'=>'Failed Operation',
                'Type'=>'danger',
                'Status'=>false
            );
            return $Result;
        }
    }
}