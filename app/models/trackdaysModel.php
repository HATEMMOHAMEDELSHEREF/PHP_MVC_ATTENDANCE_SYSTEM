<?php


namespace App\Models;
use App\Lib\Database;
class TrackDaysModel extends AbstractModel
{
    public static $TABLE_NAME   ="att_track_days";
    public static $PRIMARY_KEY  ="id";
    public static $UNIQUE_KEY   =NULL;

    public $id=null;
    public $track_id;
    public $day_id;

    public static $TABLE_SCHEMA=array(
        'track_id'            =>self::DATA_TYPE_INT,
        'day_id'              =>self::DATA_TYPE_INT,
    );

    public function Remove($id){
        $SQL="DELETE FROM ".static::$TABLE_NAME." WHERE track_id=$id";
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