<?php


namespace App\Models;


use App\Lib\Database;

class AuthenticationModel extends AbstractModel
{

    public $instructor_email;
    public $instructor_password;

    public static $PRIMARY_KEY='instructor_id';

    public static $TABLE_NAME='att_instructors';

    public static $TABLE_SCHEMA=array(

        'instructor_email'      =>self::DATA_TYPE_STRING,
        'instructor_password'   =>self::DATA_TYPE_STRING
    );

    public function LoginToSystem(){
        //LOGIN SQL OPERATION

        $HANDLER=\App\Lib\Database::Connection();
        $stmt=$HANDLER->prepare('SELECT * FROM '.static::$TABLE_NAME.' WHERE instructor_email=? and instructor_password=?');
        $stmt->execute(array($this->instructor_email,$this->instructor_password));
        $data=$stmt->fetch(\PDO::FETCH_OBJ);
        if ($stmt->rowCount()>0){
            $_SESSION['user_auth']=$this->instructor_email;
            $RETURN=array(
                'Msg'   =>'Loged Successfully',
                'Data'  =>$data,
                'Status'=>true
            );
            return $RETURN;
        }else{
            $RETURN=array(
                'Msg'   =>'Failed',
                'Data'  =>null,
                'Status'=>false
            );
            return $RETURN;
        }

    }

    public function ResetPassword($newPass,$email){
        //RESET PASSWORD OPERATION

        $SQL="UPDATE ".static::$TABLE_NAME." SET instructor_password='".$newPass."' WHERE instructor_email='".$email."'";
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $re=$Stmt->execute();
        if ($re==true){
            return true;
        }else{
            return false;
        }
    }


}