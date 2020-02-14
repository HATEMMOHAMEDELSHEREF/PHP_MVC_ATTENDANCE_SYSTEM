<?php


namespace App\Models;


use App\Lib\Database;

class StudentTracksModel extends AbstractModel
{

    public static $TABLE_NAME       ="att_student_track";
    public static $PRIMARY_KEY      ="id";
    public static $UNIQUE_KEY       =NULL;

    public static $TABLE_SCHEMA     =array(
    'student_id'                    =>self::DATA_TYPE_INT,
    'track_id'                      =>self::DATA_TYPE_INT
    );

    public $id=null;
    public $student_id;
    public $track_id;


    public function getAllStudentTrack($student_id)
    {
        $Handler=Database::Connection();
        $SQL="SELECT att_tracks.track_id,att_tracks.track_name FROM ".static::$TABLE_NAME." INNER JOIN att_tracks
        ON att_tracks.track_id=".static::$TABLE_NAME.".track_id WHERE ".static::$TABLE_NAME.".student_id=".$student_id;

        $Stmt=$Handler->prepare($SQL);
        $result=$Stmt->execute();
        if ($result===true){
            return array(
                'Msg'=>"Data Found",
                'Data'=>$Stmt->fetchAll(\PDO::FETCH_OBJ),
                'Type'=>"success",
                'Status'=>true
            );
        }else{
            return array(
              'Msg'=>"Not Found",
              'Type'=>"danger",
              'Status'=>false
            );
    }
    }

    public function Remove($condition)
    {
        $SQL="DELETE FROM ".static::$TABLE_NAME." WHERE ".$condition;
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