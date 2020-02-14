<?php


namespace App\Models;


use App\Lib\Database;

class IndexModel extends AbstractModel
{


    public static function updateRole($id,$role){
        $SQL="UPDATE att_instructors SET instructor_role='".$role."' WHERE instructor_id=".$id;
        $Handler=Database::Connection();
        $Stmt=$Handler->prepare($SQL);
        $re=$Stmt->execute();
        if ($re===true){
            return array(
              'Msg'=>'UPDATED SUCCESSFULLY',
              'Type'=>'success',
              'Status'=>true
            );
        }else{
            return array(
                'Msg'=>'FAILED TO UPDATE',
                'Type'=>'danger',
                'Status'=>false
            );
        }
    }
}