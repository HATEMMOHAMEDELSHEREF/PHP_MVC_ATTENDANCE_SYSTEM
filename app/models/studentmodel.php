<?php


namespace App\Models;
use App\Lib\Database;

class StudentModel extends AbstractModel
{

    public static $TABLE_NAME   ="att_students";
    public static $PRIMARY_KEY  ="student_id";
    public static $UNIQUE_KEY   ="student_email";

    public static $TABLE_SCHEMA =array(
        'student_name'      =>self::DATA_TYPE_STRING,
        'student_email'     =>self::DATA_TYPE_STRING,
        'student_phone'     =>self::DATA_TYPE_STRING,
        'student_level'     =>self::DATA_TYPE_STRING
    );

    public $student_id=null;
    public $student_name;
    public $student_email;
    public $student_phone;
    public $student_level;
    public $student_qr;


    public function GenerateData($ID,$TRACKS,$email,$name){
      $STUDENT_DATA="MUFIX!";
      $prepareid="id=".$ID;
        $preparetracks="tracks=";
      foreach ($TRACKS as $TRACK){
          $preparetracks.=$TRACK."@";
      }
      $preparetracks=trim($preparetracks,'@');
      $STUDENT_DATA.=$prepareid."#".$preparetracks;
      return array('Data'=>$STUDENT_DATA,'Id'=>$ID,'Email'=>$email,'Name'=>$name);
    }

    public function GenerateQr($data){
        echo '<canvas hidden id="qr"></canvas>';
        echo '<script src="/js/QRious.js"></script>';
        echo '<script src="/js/jquery.min.js"></script>';
        echo "<script>
        var id=".$data['Id']."
        ;var email='".$data['Email']."'
        ;var name='".$data['Name']."'
        ;var qr = new QRious({
        element: document.getElementById('qr'),
        value:'".$data['Data']."',
        background: 'white',
//        foreground: '#1a588a',
        foreground: '#000',
        backgroundAlpha: 1,
        foregroundAlpha: 1,
        level: 'L',
        mime: 'image/png',
        size: 120,
        padding: 15});
        var canvas = document.getElementById('qr');
        var image = canvas.toDataURL(\"image/png\", 1.0).replace(\"image/png\", \"image/octet-stream\");
        
        $.ajax({
        url:'https://www.mufix.com/student/upload',
        method:'post',
        data:{path:image},
        success:function(data) {
         var variableToSend = data;
        $.post('https://www.mufix.com/student/editpath', {qr_path: variableToSend,qr_id:id,qr_email:email,qr_name:name});
      
        }
        });
        </script>";
    }

    public static function SaveQr($id,$path){
        $SQL="UPDATE ".static::$TABLE_NAME." SET student_qr='$path' WHERE ".static::$PRIMARY_KEY."=$id";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $Stmt->execute();
    }





/*

        public function getAll($condition="")
        {
            $Handler=Database::Connection();
            $SQL="SELECT att_students.student_name,att_student_tracks.std_track_track_id,att_tracks.track_name FROM ";
            $SQL.=" att_students INNER JOIN att_student_tracks ON att_students.student_id=att_student_tracks.std_track_student_id ";
            $SQL.=" INNER JOIN att_tracks ON att_student_tracks.std_track_track_id =att_tracks.track_id ".$condition;


        }
        public function getByPk($PK)
        {
            $Handler=Database::Connection();
            $SQL="SELECT att_students.student_name,att_student_tracks.std_track_track_id,att_tracks.track_name FROM ";
            $SQL.=" att_students INNER JOIN att_student_tracks ON att_students.student_id=att_student_tracks.std_track_student_id ";
            $SQL.=" INNER JOIN att_tracks ON att_student_tracks.std_track_track_id =att_tracks.track_id WHERE att_student.student_name".$PK;




        }
*/
}