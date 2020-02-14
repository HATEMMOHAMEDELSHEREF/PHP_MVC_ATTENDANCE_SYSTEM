<?php


namespace App\Models;


use App\Lib\Database;

class SessionsModel extends AbstractModel
{
    public static $TABLE_NAME   ="att_session";
    public static $PRIMARY_KEY  ='session_id';
    public static $UNIQUE_KEY   =NULL;

    public static $TABLE_SCHEMA =array(
        'session_name'               =>self::DATA_TYPE_STRING,
        'session_track_id'           =>self::DATA_TYPE_INT,
        'session_instructor_id'      =>self::DATA_TYPE_INT
    );

    public $session_id;
    public $session_name;
    public $session_track_id;
    public $session_instructor_id;
    public $session_date;
    public $session_status;

    public function getAllSession($id=null){
        $cond="";
        if ($id!=null and !empty($id)){
            $cond=" WHERE instructor_id=".$id;
        }
      $SQL="SELECT i.instructor_name,t.track_name,t.track_id,p.place_name,s.session_id,s.session_name,s.session_status
      ,s.session_date FROM att_instructors i INNER JOIN att_session s ON i.instructor_id=s.session_instructor_id
      INNER JOIN att_tracks t ON t.track_id=s.session_track_id INNER JOIN att_places p ON t.track_place_id=p.place_id ".$cond;
      $Handler=Database::Connection();
      $Stmt=$Handler->prepare($SQL);
      $re=$Stmt->execute();
      if ($re===true){
          $result=array(
              'Msg'=>'Data Founded',
              'Type'=>'success',
              'Data'=>$Stmt->fetchAll(\PDO::FETCH_OBJ),
              'Status'=>true
          );
          echo  json_encode($result);
      }else{
          $result=array(
              'Msg'=>'Data Not Found',
              'Type'=>'danger',
              'Status'=>false
          );
          return json_encode($result);
      }

    }
    //'YYYY-MM-DD hh:mm:ss' date format of mysql

    public function updateStatus($session_id,$status){
        $SQL="UPDATE ".static::$TABLE_NAME." SET session_status='$status' WHERE session_id=$session_id";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $re=$Stmt->execute();
        if ($re==true){
            return true;
        }else{
            return false;
        }


    }
    function MakeAbsense($track_id,$session_id){

        //RETURN ALL STUDENT OF SELECTED TRACK
        $SQL="SELECT student_id FROM att_student_track WHERE track_id=$track_id";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $re=$Stmt->execute();
        if ($re===true){
            $data=$Stmt->fetchAll(\PDO::FETCH_OBJ);
            $ABSENSE=new AbsenseModel();
            $curdate=date('Y-m-d');
            foreach($data as $item){
                $ABSENSE->absense_student_id=$item->student_id;
                $ABSENSE->absense_session_id=$session_id;
                $ABSENSE->absense_date=$curdate;
                $ABSENSE->save();
                //$SQL="INSERT INTO att_absense (absense_session_id,absense_student_id,absense_date) VALUES ($session_id,$item->student_id,'$curdate')";
               // $Stmt=$Handler->prepare($SQL);
                //$Stmt->execute();
            }
            return true;
        }else{
            return false;
        }
    }


}