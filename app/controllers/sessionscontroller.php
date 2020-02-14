<?php


namespace App\Controllers;


use App\Lib\Helper;
use App\Lib\Services;
use App\Models\AbsenseModel;
use App\Models\SessionsModel;

class SessionsController extends AbstractController
{
    public function defaultAction()
    {
       $this->ACTION="showall";
       $this->showallAction();
    }

    public function addAction(){
    $instructor_id=$_SESSION['user_auth']['Data']->instructor_id;
    $result=Services::getAll('att_session','*',' WHERE (session_status=\'pending\' or session_status=\'running\') and session_instructor_id='.$instructor_id);
        if ($result['Status']==true){
            if (count($result['Data'])>0){
                $re=array(
                    'Msg'=>'Now There Are Opened Session You Can\'t Create New Untill Terminate It First',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['session']=$re;
                 Helper::Redirect('/sessions/track');
                // there are session running or pending so that he cant create new session untill terminate the opened first
            }else{

                if ($_SERVER['REQUEST_METHOD']=="POST"){
                    if (isset($_POST['session_name']) and !empty($_POST['session_name'])){
                        $session_name=Helper::Filter_String($_POST['session_name']);
                        if ($session_name==null){// invalid sesion name

                        }else{
                            if (isset($_POST['session_track_id']) and !empty($_POST['session_track_id'])){
                                $session_track=Helper::Filter_Int($_POST['session_track_id']);
                                if ($session_track==false){
                                    $re=array(
                                        'Msg'=>'Invalid Track Id',
                                        'Type'=>'danger',
                                        'Status'=>false
                                    );
                                    $_SESSION['session']=$re;
                                    Helper::Redirect('/sessions/add');
                                    // invalid track id
                                }else{
                                    $result=Services::getAll('att_tracks');
                                    if ($result['Status']==false){
                                        $re=array(
                                            'Msg'=>'Invalid Track No Tracks Founded',
                                            'Type'=>'danger',
                                            'Status'=>false
                                        );
                                        $_SESSION['session']=$re;
                                        Helper::Redirect('/sessions/add');
                                        // redirect to home no tracks founded
                                    }else{// valid data is here
                                        $alltracksid=array_column($result['Data'],'track_id');
                                        if (in_array($session_track,$alltracksid)){
                                            $SESSION=new SessionsModel();
                                            $instructor_id=$_SESSION['user_auth']['Data']->instructor_id;
                                            $SESSION->session_instructor_id=$instructor_id;
                                            $SESSION->session_name=$session_name;
                                            $SESSION->session_track_id=$session_track;
                                            $re=$SESSION->save();
                                            if ($re['Status']==true){
                                                // redirect to home as he can't insert again if there is a session pending
                                                $_SESSION['session']=$re;
//                                                $_SESSION['_session_track_id_']=$SESSION->session_track_id;
//                                                $_SESSION['_session_instructor_id_']=$SESSION->session_instructor_id;
                                                echo'<meta http-equiv="refresh" content="0;url=/sessions/track">';
                                            }else{
                                                // invalid operation
                                                $_SESSION['session']=$re;
                                                Helper::Redirect('/sessions/add');
                                            }
                                        }else{
                                            $re=array(
                                                'Msg'=>'Invalid Track ,Track Not Found',
                                                'Type'=>'danger',
                                                'Status'=>false
                                            );
                                            $_SESSION['session']=$re;
                                            Helper::Redirect('/sessions/add');
                                            //track not found
                                        }
                                    }
                                }
                            }else{//track id must be not empty
                                $re=array(
                                    'Msg'=>'Invalid Track ,Track Must Not Be Empty',
                                    'Type'=>'danger',
                                    'Status'=>false
                                );
                                $_SESSION['session']=$re;
                                Helper::Redirect('/sessions/add');
                            }
                        }
                    }else{//session name must not be empty
                        $re=array(
                            'Msg'=>'Invalid Session Name, Session Name Must Not Be Empty',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['session']=$re;
                        Helper::Redirect('/sessions/add');
                    }
                }else{
                    $instructor_id=$_SESSION['user_auth']['Data']->instructor_id;
                    $current_date=date('Y-m-d');
                    $instructor_name=$_SESSION['user_auth']['Data']->instructor_name;
                    $result=Services::getAll('att_tracks','track_id,track_name','WHERE track_instructor_id='.$instructor_id);
                    if($result['Status']==true){
                        $track_name=$result['Data'];
                        $Result=array();
                        array_push($Result,$track_name);
                        array_push($Result,$instructor_name);
                        array_push($Result,$current_date);
                        $this->_DATA['session']=$Result;
                        $this->view();
                    }else{
                        $result=array(
                            'Msg'=>'No Tracks Assigned To You !!!',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['session']=$result;
                        Helper::Redirect('/sessions/track');
                    }
                }
            }
        }

    }

    public function showallAction(){
        $this->view();
    }
    public function getSessionsAction(){
        if (isset($_POST['id'])){
            $SESSION=new SessionsModel();
            $SESSION->getAllSession($_POST['id']);
        }
    }
    public function trackAction(){

        $this->view();

    }
    public function startsessionAction(){
        if (isset($_POST)){
            $SESSION=new SessionsModel();
            $re=$SESSION->updateStatus($_POST['session_id'],'running');
            if ($re===true){
                // make absense
                $re=$SESSION->MakeAbsense($_POST['track_id'],$_POST['session_id']);
                if ($re==true){
                    echo json_encode(['result'=>true]);
                }else{
                    echo json_encode(['result'=>false]);
                }
            }else{
                echo json_encode(['result'=>false]);
            }
        }
    }

    public function endsessionAction(){
        if (isset($_POST)){
            $SESSION=new SessionsModel();
            $re=$SESSION->updateStatus($_POST['session_id'],'finished');
            if ($re===true){
                echo json_encode(['result'=>true]);
            }else{
                echo json_encode(['result'=>false]);
            }
        }
    }

    public function editAction(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $session_id=$_POST['session_id'];
            if (isset($_POST['session_name']) and !empty($_POST['session_name'])){
                $session_name=Helper::Filter_String($_POST['session_name']);
                if ($session_name==null){// invalid sesion name
                    $re=array(
                        'Msg'=>'Invalid Session Name, Session Name Must Not Be Empty',
                        'Type'=>'danger',
                        'Status'=>false
                    );
                    $_SESSION['session']=$re;
                    Helper::Redirect('/sessions/edit/'.$session_id);
                }else{
                    if (isset($_POST['session_track_id']) and !empty($_POST['session_track_id'])){
                        $session_track=Helper::Filter_Int($_POST['session_track_id']);
                        if ($session_track==false){
                            $re=array(
                                'Msg'=>'Invalid Track Id',
                                'Type'=>'danger',
                                'Status'=>false
                            );
                            $_SESSION['session']=$re;
                            Helper::Redirect('/sessions/edit/'.$session_id);
                            // invalid track id
                        }else{
                            $result=Services::getAll('att_tracks');
                            if ($result['Status']==false){
                                $re=array(
                                    'Msg'=>'Invalid Track No Tracks Founded',
                                    'Type'=>'danger',
                                    'Status'=>false
                                );
                                $_SESSION['session']=$re;
                                Helper::Redirect('/sessions/edit/'.$session_id);
                                // redirect to home no tracks founded
                            }else{// valid data is here
                                $alltracksid=array_column($result['Data'],'track_id');
                                if (in_array($session_track,$alltracksid)){
                                    $SESSION=new SessionsModel();
                                    $instructor_id=$_SESSION['user_auth']['Data']->instructor_id;
                                    $SESSION->session_instructor_id=$instructor_id;
                                    $SESSION->session_id=$session_id;
                                    $SESSION->session_name=$session_name;
                                    $SESSION->session_track_id=$session_track;
                                    $re=$SESSION->save();
                                    if ($re['Status']==true){
                                        // redirect to home as he can't insert again if there is a session pending
                                        $_SESSION['session']=$re;
//                                                $_SESSION['_session_track_id_']=$SESSION->session_track_id;
//                                                $_SESSION['_session_instructor_id_']=$SESSION->session_instructor_id;
                                        Helper::Redirect('/sessions/edit/'.$session_id);                                    }else{
                                        // invalid operation
                                        $_SESSION['session']=$re;
                                        Helper::Redirect('/sessions/edit/'.$session_id);
                                    }
                                }else{
                                    $re=array(
                                        'Msg'=>'Invalid Track ,Track Not Found',
                                        'Type'=>'danger',
                                        'Status'=>false
                                    );
                                    $_SESSION['session']=$re;
                                    Helper::Redirect('/sessions/edit/'.$session_id);
                                    //track not found
                                }
                            }
                        }
                    }else{//track id must be not empty
                        $re=array(
                            'Msg'=>'Invalid Track ,Track Must Not Be Empty',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['session']=$re;
                        Helper::Redirect('/sessions/edit/'.$session_id);
                    }
                }
            }else{//session name must not be empty
                $re=array(
                    'Msg'=>'Invalid Session Name, Session Name Must Not Be Empty',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['session']=$re;
                Helper::Redirect('/sessions/edit/'.$session_id);
            }
        }else{

            if (isset($this->PARAMS[0]) and !empty($this->PARAMS[0])){
                $PK=Helper::Filter_Int($this->PARAMS[0]);
                if ($PK===false){
                    // incalid session is
                }else{
                    $SESSION=new SessionsModel();
                    $re=$SESSION->getByPk($PK);
                    if ($re['Status']==true){
                        $instructor_id=$_SESSION['user_auth']['Data']->instructor_id;
                        $instructor_name=$_SESSION['user_auth']['Data']->instructor_name;
                        $result=Services::getAll('att_tracks','track_id,track_name','WHERE track_instructor_id='.$instructor_id);
                        if($result['Status']==true){
                            $track_name=$result['Data'];
                            $Result=array();
                            array_push($Result,$track_name);
                            array_push($Result,$instructor_name);
                            array_push($Result,$re['Data']);
                            $this->_DATA['session']=$Result;
                            $this->view();
                        }else{
                            $result=array(
                                'Msg'=>'No Tracks Assigned To You !!!',
                                'Type'=>'danger',
                                'Status'=>false
                            );
                            $_SESSION['session']=$result;
                            Helper::Redirect('/sessions/track');
                        }

                    }else{
                        // session id not found
                        $result=array(
                            'Msg'=>'No Sessions Founded !!!',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['session']=$result;
                        Helper::Redirect('/sessions/track');
                    }
                }

            }else{
                // redirect to home with msg invalid session id
                $result=array(
                    'Msg'=>'No Sessions Founded Select Right Session First !!!',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['session']=$result;
                Helper::Redirect('/sessions/track');
            }

        }
    }

    public function deleteAction(){
        if (isset($this->PARAMS[0]) and !empty($this->PARAMS[0])) {
            $PK = Helper::Filter_Int($this->PARAMS[0]);
            if ($PK === false) {
                // invalid session id
                $re=array(
                    'Msg'=>'Invalid Session Id',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['session']=$re;
                Helper::Redirect('/sessions/track');
            } else {
                $SESSION = new SessionsModel();
                $re = $SESSION->getByPk($PK);
                if ($re['Status']==true){
                    $SESSION=new SessionsModel();
                    $re=$SESSION->Remove($PK);
                    if ($re['Status']==true){
                        Services::Remove('att_absense','absense_session_id='.$PK);
                        $_SESSION['session']=$re;
                        Helper::Redirect('/sessions/track');
                    }else{
                        $_SESSION['session']=$re;
                        Helper::Redirect('/sessions/track');
                    }
                }else{
                    // session id not found
                    $re=array(
                        'Msg'=>'Invalid Session .Session Not Found',
                        'Type'=>'danger',
                        'Status'=>false
                    );
                    $_SESSION['session']=$re;
                    Helper::Redirect('/sessions/track');
                }
            }
        }else{
            // id must not be empty
            $re=array(
                'Msg'=>'Session Id Must Not Be Empty',
                'Type'=>'danger',
                'Status'=>false
            );
            $_SESSION['session']=$re;
            Helper::Redirect('/sessions/track');
        }
    }



}