<?php


namespace App\Models;


class PlacesModel extends AbstractModel
{
    public static $TABLE_NAME   ="att_places";
    public static $UNIQUE_KEY   ="place_name";
    public static $PRIMARY_KEY  ="place_id";

    public $place_id=null;

    public $place_name;

    public static $TABLE_SCHEMA=array(
      'place_name'  =>self::DATA_TYPE_STRING
    );
}