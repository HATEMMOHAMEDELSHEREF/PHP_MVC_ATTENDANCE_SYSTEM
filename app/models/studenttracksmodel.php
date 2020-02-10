<?php


namespace App\Models;


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

}