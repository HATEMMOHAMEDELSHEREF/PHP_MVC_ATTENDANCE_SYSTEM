<?php


namespace App\Models;


use App\Lib\Database;

class TracksModel extends AbstractModel
{
    public static $TABLE_NAME   ="att_tracks";
    public static $PRIMARY_KEY  ="track_id";
    public static $UNIQUE_KEY   ="track_name";

    public $track_id;
    public $track_name;
    public $track_instructor_id;
    public $track_cost;
    public $track_place_id;

    public static $TABLE_SCHEMA=array(
        'track_name'            =>self::DATA_TYPE_STRING,
        'track_instructor_id'   =>self::DATA_TYPE_INT,
        'track_cost'            =>self::DATA_TYPE_FLOAT,
        'track_place_id'        =>self::DATA_TYPE_INT
    );
    public function getAll()
    {
        $SQL="SELECT track_id,track_name,track_cost,place_name,instructor_name FROM att_tracks INNER JOIN att_places ";
        $SQL.=" ON att_tracks.track_place_id=att_places.place_id INNER JOIN att_instructors ";
        $SQL.=" ON att_tracks.track_instructor_id=att_instructors.instructor_id";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $Stmt->execute();
        $RESULT['tracks']=$Stmt->fetchAll(\PDO::FETCH_OBJ);
        $SQL="select day_name,track_name,att_tracks.track_id FROM att_week_days ";
        $SQL.="INNER JOIN att_track_days ON att_week_days.day_id=att_track_days.day_id INNER JOIN att_tracks ON att_tracks.track_id=att_track_days.track_id";
        $Stmt=$Handler->prepare($SQL);
        $Stmt->execute();
        $RESULT['tracks_days']=$Stmt->fetchAll(\PDO::FETCH_OBJ);
       return $RESULT;
    }

}