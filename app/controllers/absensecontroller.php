<?php


namespace App\Controllers;


use App\Lib\Database;
use App\Lib\Helper;
use App\Models\AbsenseModel;
use App\Models\StudentModel;

class AbsenseController extends AbstractController
{
    public function takeabsenseAction(){
        if (isset($_POST['data'])){
            $data=$_POST['data'];
            $prefix=substr($data,0,5);
            if (isset($prefix) and $prefix=="MUFIX"){
                $dataparts=explode('!',$data);
                if ($dataparts[0]=="MUFIX"){
                    $dataparts=$dataparts[1];
                    $dataparts=explode('#',$dataparts);
                    $temp=explode('=',$dataparts[1]);
                    $tracks=end($temp);
                    $tracks=explode('@',$tracks);
                    $temp=explode('=',$dataparts[0]);
                    $id=end($temp);
                    $STUDENT=new StudentModel();
                    $Result=$STUDENT->getByPk($id);
                    // echo $id;
                    if ($Result['Status']===true){
                        if (in_array($_SESSION['__SESSION__TRACK__ID'],$tracks)){
                            $student=$id;
                            $session=$_SESSION['__SESSION__ID'];
                            //$date=date('Y-m-d');
                            // update his status
                            // check with  session id and date for this student if attended or not
                            //if not attend it by update command
                            $SQL="SELECT absense_id,absense_status FROM att_absense WHERE absense_session_id=".$session." AND absense_student_id=".$student;
                            $Handler=Database::Connection();
                            $Stmt=$Handler->prepare($SQL);
                            $re=$Stmt->execute();
                            if ($re==true){
                                if ($Stmt->rowCount()>0){
                                    $absensedata=$Stmt->fetch(\PDO::FETCH_OBJ);
                                    if ($absensedata->absense_status=='attended'){
                                        //student already attended
                                        echo json_encode(array('Status'=>true,'func'=>1));
                                    }else{
                                        // make update here to attend student
                                        $SQL="UPDATE att_absense SET absense_status='attended' WHERE absense_id=".$absensedata->absense_id;
                                        $Handler=Database::Connection();
                                        $Stmt=$Handler->prepare($SQL);
                                        $re=$Stmt->execute();
                                        echo json_encode(array('Status'=>true,'func'=>2));
                                    }
                                }else{
                                    //student not found
                                    echo json_encode(array('Status'=>false,'func'=>1));
                                }
                            }else{
                                //invalid operation
                                echo json_encode(array('Status'=>false,'func'=>0));
                            }
                        }else{
                            echo json_encode(array('Status'=>false,'func'=>3));
                            //student not exist in this track
                        }
                    }else{
                        echo json_encode(array('Status'=>false,'func'=>1));
                        //student not found in db
                    }
                }else{
                    echo json_encode(array('Status'=>false,'func'=>1));
                    //student not found in db
                }
            }else{
                echo json_encode(array('Status'=>false,'func'=>2));
                // student un defined in mufix trainning
            }
        }

    }
    public function startabsenseAction(){
        $result=AbsenseModel::getOpenedSession($_SESSION['user_auth']['Data']->instructor_id);
        if ($result['Status']==true){
            if ($result['Data']->session_status=="pending"){
                $result=array(
                  'Msg'=>"Please Start The Session First",
                  'Type'=>'primary',
                  'Status'=>false
                );
                $_SESSION['session']=$result;
                Helper::Redirect('/sessions/track');
            }
            $_SESSION['__SESSION__ID']=$result['Data']->session_id;
            $_SESSION['__SESSION__TRACK__ID']=$result['Data']->session_track_id;
            $_SESSION['__SESSION__NAME']=$result['Data']->session_name;
             $this->view();
        }else{
            $_SESSION['session']=$result;
            Helper::Redirect('/sessions/add');
        }
    }
    public function traceabsenseAction(){
        $this->view();
    }
    public function studentabsenseAction(){
        $this->view();
    }

}