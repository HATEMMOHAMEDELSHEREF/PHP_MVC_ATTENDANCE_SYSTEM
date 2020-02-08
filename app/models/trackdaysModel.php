<?php


namespace App\Models;


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


}