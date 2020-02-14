<?php


namespace App\Controllers;


use App\Lib\Helper;
use App\Lib\Services;
use App\Lib\Mailer;
use App\Lib\Uploader;
use App\Models\StudentModel;
use App\Models\StudentTracksModel;
use Exception;


class StudentController extends AbstractController
{

    public function defaultAction()
    {
        $STUDENT=new StudentModel();
        $Result=$STUDENT->getAll();
        $this->_DATA['student']=$Result;
        $this->view();
    }
    public function addAction(){
        if ($_SERVER['REQUEST_METHOD']==="POST"){
           if (isset($_POST['student_name']) and !empty($_POST['student_name'])){
                $student_name=$_POST['student_name'];
                if (Helper::Filter_String($student_name)!=null){
                    if (isset($_POST['student_email']) and !empty($_POST['student_email'])){
                        $student_email=$_POST['student_email'];
                        if (Helper::FilterEmail($student_email)!==false){
                            if (isset($_POST['student_phone']) and !empty($_POST['student_phone'])){
                                $student_phone=$_POST['student_phone'];
                                if (Helper::FilterPhone($student_phone)===false){
                                    $Result=array(
                                        'Msg'=>'Invalid Student Phone',
                                        'Type'=>'danger',
                                        'Status'=>false
                                    );
                                    $_SESSION['student']=$Result;
                                    Helper::Redirect('/student/add');
                                }else{//valid phone
                                    if (isset($_POST['student_level']) and !empty($_POST['student_level'])){
                                        $student_level=$_POST['student_level'];
                                        $levels=array(1,2,3,4,'other');
                                        if (in_array($student_level,$levels)){
                                            if (isset($_POST['student_track']) and !empty($_POST['student_track'])){
                                                $tracks_id=$_POST['student_track'];
                                                $result_tracks=Services::getAll('att_tracks');
                                                if ($result_tracks['Status']===true){
                                                    $tracks=array_column($result_tracks['Data'],'track_id');
                                                    foreach ($tracks_id as $id){
                                                        if (in_array($id,$tracks)){
                                                            continue;
                                                        }else{
                                                            $Result=array(
                                                                'Msg'=>'Invalid Student Tracks',
                                                                'Type'=>'danger',
                                                                'Status'=>false
                                                            );
                                                            $_SESSION['student']=$Result;
                                                            Helper::Redirect('/student/add');
                                                        }
                                                    }

                                                    //All Thing Is Ok
                                                    $STUDENT=new StudentModel();
                                                    $STUDENT->student_name=$student_name;
                                                    $STUDENT->student_email=$student_email;
                                                    $STUDENT->student_phone=$student_phone;
                                                    $STUDENT->student_level=$student_level;
//                                                   echo 'student model<br>';
//                                                    var_dump($STUDENT);
                                                        $result=$STUDENT->save();
//                                                        echo 'result of insert student data<br>';
//                                                    var_dump($result);
                                                        if ($result['Status']===true){
                                                            $lastid=$result['ID'];
                                                            $STDTRACKS=new StudentTracksModel();
                                                            foreach ($tracks_id as $id){
                                                                $STDTRACKS->track_id=$id;
                                                                $STDTRACKS->student_id=$lastid;
                                                                $STDTRACKS->save();
//                                                               echo 'save track<br>';
                                                            }
                                                            $_SESSION['student']=$result;
                                                            $MYTRACKS=$tracks_id;

                                                            $data=$STUDENT->GenerateData($lastid,$MYTRACKS,$student_email,$student_name);
                                                            $STUDENT->GenerateQr($data);
                                                            echo "<meta http-equiv=\"refresh\" content=\"0;url='/student/add'\">";
//var_dump($data);
                                                        }else{
                                                            var_dump($result);
                                                            $_SESSION['student']=$result;
                                                            Helper::Redirect('/student/add');
                                                        }
                                                }else{//invalid tracks
                                                    $_SESSION['student']=$result_tracks['Data'];

                                                }
                                            }else{//tracks no set
                                                $Result=array(
                                                    'Msg'=>'Invalid Student Tracks Select At Least One',
                                                    'Type'=>'danger',
                                                    'Status'=>false
                                                );
                                                $_SESSION['student']=$Result;
                                                Helper::Redirect('/student/add');
                                            }
                                        }else{//invalid level
                                            $Result=array(
                                                'Msg'=>'Invalid Student Level',
                                                'Type'=>'danger',
                                                'Status'=>false
                                            );
                                            $_SESSION['student']=$Result;
                                            Helper::Redirect('/student/add');
                                        }
                                    }else{//level not set
                                        $Result=array(
                                            'Msg'=>'Invalid Student Level',
                                            'Type'=>'danger',
                                            'Status'=>false
                                        );
                                        $_SESSION['student']=$Result;
                                        Helper::Redirect('/student/add');
                                    }
                                }
                            }else{//phone not set
                                $Result=array(
                                    'Msg'=>'Invalid Student Phone',
                                    'Type'=>'danger',
                                    'Status'=>false
                                );
                                $_SESSION['student']=$Result;
                                Helper::Redirect('/student/add');
                            }
                        }else{//invalid email
                            $Result=array(
                                'Msg'=>'Invalid Student Email',
                                'Type'=>'danger',
                                'Status'=>false
                            );
                            $_SESSION['student']=$Result;
                            Helper::Redirect('/student/add');
                        }
                    }else{//if email not set
                        $Result=array(
                            'Msg'=>'Invalid Student Email',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['student']=$Result;
                        Helper::Redirect('/student/add');
                    }
                }else{//invalid string
                    $Result=array(
                        'Msg'=>'Invalid Student Name',
                        'Type'=>'danger',
                        'Status'=>false
                    );
                    $_SESSION['student']=$Result;
                    Helper::Redirect('/student/add');
                }
            }else{//if name not set
                $Result=array(
                    'Msg'=>'Invalid Student Name',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['student']=$Result;
                Helper::Redirect('/student/add');
            }
        }else{
            $Result=Services::getAll('att_tracks');
            if ($Result['Status']===true){
                $this->_DATA['tracks']=$Result['Data'];
                $this->view();
            }else{
                $_SESSION['student']=$Result;
                Helper::Redirect('/student/add');
            }
        }
    }
    public function deleteAction(){
        if (isset($this->PARAMS['0']) and !empty($this->PARAMS[0])){
            $PK=$this->PARAMS[0];
            if (Helper::Filter_Int($PK)===false){
                $result= array(
                    'Msg'=>'Student Not Found',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['student']=$result;
                Helper::Redirect('/student/default');
            }else{
                $STUDENT=new StudentModel();
                $Result=$STUDENT->getByPk($PK);
                if ($Result['Status']===true){
                    $result=$STUDENT->Remove($PK);
                    if ($result['Status']==true){
                        $condition=" student_id=".$PK;
                        Uploader::RemoveOld("".$Result['Data'][0]->student_qr);
                        $STUDENTTRACK=new StudentTracksModel();
                        $result=$STUDENTTRACK->Remove($condition);
                        if ($result['Status']==true){
                            $_SESSION['student']=$result;
                            Helper::Redirect('/student/default');
                        }else{
                            $_SESSION['student']=$result;
                            Helper::Redirect('/student/default');
                        }
                    }else{
                        $_SESSION['student']=$result;
                        Helper::Redirect('/student/default');
                    }
                }else{
                    $result= array(
                        'Msg'=>'Student Not Found',
                        'Type'=>'danger',
                        'Status'=>false
                    );
                    $_SESSION['student']=$result;
                    Helper::Redirect('/student/default');
                }
            }
        }
    }
    public function editAction(){
        if ($_SERVER['REQUEST_METHOD']==="POST"){
            // for more security you  may store student id to make update in session instead of hidden input
            $student_id=$_POST['student_id'];
            $student_qr=$_POST['student_qr'];
            if (isset($_POST['student_name']) and !empty($_POST['student_name'])){
                $student_name=$_POST['student_name'];
                if (Helper::Filter_String($student_name)!=null){
                    if (isset($_POST['student_email']) and !empty($_POST['student_email'])){
                        $student_email=$_POST['student_email'];
                        if (Helper::FilterEmail($student_email)!==false){
                            if (isset($_POST['student_phone']) and !empty($_POST['student_phone'])){
                                $student_phone=$_POST['student_phone'];
                                if (Helper::FilterPhone($student_phone)===false){
                                    $Result=array(
                                        'Msg'=>'Invalid Student Phone',
                                        'Type'=>'danger',
                                        'Status'=>false
                                    );
                                    $_SESSION['student']=$Result;
                                    Helper::Redirect('/student/edit/'.$student_id);
                                }else{//valid phone
                                    if (isset($_POST['student_level']) and !empty($_POST['student_level'])){
                                        $student_level=$_POST['student_level'];
                                        $levels=array(1,2,3,4,'other');
                                        if (in_array($student_level,$levels)){
                                            if (isset($_POST['student_track']) and !empty($_POST['student_track'])){
                                                $tracks_id=$_POST['student_track'];
                                                $result_tracks=Services::getAll('att_tracks');
                                                if ($result_tracks['Status']===true){
                                                    $tracks=array_column($result_tracks['Data'],'track_id');
                                                    foreach ($tracks_id as $id){
                                                        if (in_array($id,$tracks)){
                                                            continue;
                                                        }else{
                                                            $Result=array(
                                                                'Msg'=>'Invalid Student Tracks',
                                                                'Type'=>'danger',
                                                                'Status'=>false
                                                            );
                                                            $_SESSION['student']=$Result;
                                                            Helper::Redirect('/student/edit/'.$student_id);
                                                        }
                                                    }

                                                    //All Thing Is Ok
                                                    $STUDENT=new StudentModel();
                                                    $STUDENT->student_id=$student_id;
                                                    $STUDENT->student_name=$student_name;
                                                    $STUDENT->student_email=$student_email;
                                                    $STUDENT->student_phone=$student_phone;
                                                    $STUDENT->student_level=$student_level;
//                                                   echo 'student model<br>';
//                                                    var_dump($STUDENT);
                                                    $result=$STUDENT->save();
//                                                        echo 'result of insert student data<br>';
//                                                    var_dump($result);
                                                    if ($result['Status']===true){
                                                        $STDTRACKS=new StudentTracksModel();
                                                        $re=$STDTRACKS->Remove(' student_id='.$student_id);
                                                        // remove all old tracks first and then insert
                                                        if ($re['Status']==true){
                                                            foreach ($tracks_id as $id){
                                                                $STDTRACKS->track_id=$id;
                                                                $STDTRACKS->student_id=$student_id;
                                                                $STDTRACKS->save();
//                                                               echo 'save track<br>';
                                                            }
                                                            $_SESSION['student']=$result;
                                                            $MYTRACKS=$tracks_id;
                                                            Uploader::RemoveOld($student_qr);
                                                            $data=$STUDENT->GenerateData($student_id,$MYTRACKS,$student_email,$student_name);
                                                            $STUDENT->GenerateQr($data);
                                                            echo "<meta http-equiv=\"refresh\" content=\"0;url='/student/edit/".$student_id."'\">";
//var_dump($data);
                                                        }else{
                                                            $_SESSION['student']=$re;
                                                            Helper::Redirect('/student/edit/'.$student_id);
                                                        }

                                                    }else{
//                                                            var_dump($result);
                                                        $_SESSION['student']=$result;
                                                        Helper::Redirect('/student/edit/'.$student_id);
                                                    }
                                                }else{//invalid tracks
                                                    $_SESSION['student']=$result_tracks['Data'];

                                                }
                                            }else{//tracks no set
                                                $Result=array(
                                                    'Msg'=>'Invalid Student Tracks Select At Least One',
                                                    'Type'=>'danger',
                                                    'Status'=>false
                                                );
                                                $_SESSION['student']=$Result;
                                                Helper::Redirect('/student/edit/'.$student_id);
                                            }
                                        }else{//invalid level
                                            $Result=array(
                                                'Msg'=>'Invalid Student Level',
                                                'Type'=>'danger',
                                                'Status'=>false
                                            );
                                            $_SESSION['student']=$Result;
                                            Helper::Redirect('/student/edit/'.$student_id);
                                        }
                                    }else{//level not set
                                        $Result=array(
                                            'Msg'=>'Invalid Student Level',
                                            'Type'=>'danger',
                                            'Status'=>false
                                        );
                                        $_SESSION['student']=$Result;
                                        Helper::Redirect('/student/edit/'.$student_id);
                                    }
                                }
                            }else{//phone not set
                                $Result=array(
                                    'Msg'=>'Invalid Student Phone',
                                    'Type'=>'danger',
                                    'Status'=>false
                                );
                                $_SESSION['student']=$Result;
                                Helper::Redirect('/student/edit/'.$student_id);
                            }
                        }else{//invalid email
                            $Result=array(
                                'Msg'=>'Invalid Student Email',
                                'Type'=>'danger',
                                'Status'=>false
                            );
                            $_SESSION['student']=$Result;
                            Helper::Redirect('/student/edit/'.$student_id);
                        }
                    }else{//if email not set
                        $Result=array(
                            'Msg'=>'Invalid Student Email',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['student']=$Result;
                        Helper::Redirect('/student/edit/'.$student_id);
                    }
                }else{//invalid string
                    $Result=array(
                        'Msg'=>'Invalid Student Name',
                        'Type'=>'danger',
                        'Status'=>false
                    );
                    $_SESSION['student']=$Result;
                    Helper::Redirect('/student/edit/'.$student_id);
                }
            }else{//if name not set
                $Result=array(
                    'Msg'=>'Invalid Student Name',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['student']=$Result;
                Helper::Redirect('/student/edit/'.$student_id);
            }
        }
        else{

            if (isset($this->PARAMS['0']) and !empty($this->PARAMS[0])){
                $PK=$this->PARAMS[0];
                if (Helper::Filter_Int($PK)===false){
                    $result= array(
                        'Msg'=>'Student Not Found',
                        'Type'=>'danger',
                        'Status'=>false
                    );
                    $_SESSION['student']=$result;
                    Helper::Redirect('/student/default');
                }else{
                    $STUDENT=new StudentModel();
                    $Result=$STUDENT->getByPk($PK);
                    if ($Result['Status']==true){
                        $STUDENTTRACK=new StudentTracksModel();
                        $Result_2=$STUDENTTRACK->getAllStudentTrack($PK);

                        $this->_DATA['student']=$Result['Data'];
                        $this->_DATA['student_tracks']=$Result_2['Data'];

                    }else{
                        $_SESSION['student']=$Result;
                        Helper::Redirect('/student/default');
                    }
                }
            }
            $Result=Services::getAll('att_tracks');
            if ($Result['Status']===true){
                $this->_DATA['tracks']=$Result['Data'];
                $this->view();
            }else{
                $_SESSION['student']=$Result;
                Helper::Redirect('/student/add');
            }
        }
    }
    public function searchAction(){
        /*
      * function that read qr image and check if student exist or not if exist get information and show it if not return  no
      * */
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
                        echo json_encode($Result);
                    }else{
                        echo json_encode(array('Status'=>false));
                    }
                }else{
                    echo json_encode(array('Status'=>false));
                }
            }else{
                echo json_encode(array('Status'=>false));
            }
        }else{
            $this->view();
        }

    }
    public function parseAction(){
        /*
         * function that read qr image and check if student exist or not if exist get information and show it if not return  no
         * */
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
                   echo json_encode($Result);
               }else{
                   echo json_encode(array('Status'=>false));
               }
           }else{
               echo json_encode(array('Status'=>false));
           }
       }else{
           echo json_encode(array('Status'=>false));
       }
    }

    public function showallAction(){
        /*
         * function work as the same as default action function
         * */
        $this->setAction('default');
        $this->defaultAction();
    }

    public function uploadAction(){
        /*
         * function take the path of the qr image data url that has been sent  by post request that upload it to server
         * */
        if (isset($_POST['path'])){
            $name='QR/'.date('Y-m-d').substr(md5(uniqid()),0,10).'.png';
            try{
                $path=$_POST['path'];
                if (copy($path,$name)){
                    echo "".$name."";
                }else{
                    echo 'failed';
                }
            }catch (Exception $e){
                echo 'exception thrown';
            }

        }

    }

    public function editpathAction(){
        /*
         * function that receive student name,student email,student id,student qr image path and update this record
         * with column student_qr of id that received and send email to the person with email that has been received with
         * attachment the image of qr
         * */
        if (isset($_POST)){
           StudentModel::SaveQr($_POST['qr_id'],$_POST['qr_path']);
            //Mailer::SendMail($_POST['qr_path'],$_POST['qr_email'],$_POST['qr_name']);
            $this->sendmailAction();
        }

    }
    public function sendmailAction(){
        if (isset($_POST)){

            Mailer::SendMail($_POST['qr_path'],$_POST['qr_email'],$_POST['qr_name']);
        }
    }



}