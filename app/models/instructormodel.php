<?php


namespace App\Models;


class InstructorModel extends AbstractModel
{

    public static $TABLE_NAME       ='att_instructors';
    public static $PRIMARY_KEY      ='instructor_id';
    public static $UNIQUE_KEY       ='instructor_email';

    public $instructor_id=NULL;
    public $instructor_name;
    public $instructor_email;
    public $instructor_phone;
    public $instructor_avatar='/images/default_user.png';
    public $instructor_password;
    public $instructor_role     ='general';

    public static $TABLE_SCHEMA =array(
        'instructor_name'       =>self::DATA_TYPE_STRING,
        'instructor_email'      =>self::DATA_TYPE_STRING,
        'instructor_phone'      =>self::DATA_TYPE_STRING,
        'instructor_avatar'     =>self::DATA_TYPE_STRING,
        'instructor_password'   =>self::DATA_TYPE_STRING,
        'instructor_role'       =>self::DATA_TYPE_STRING
    );



}