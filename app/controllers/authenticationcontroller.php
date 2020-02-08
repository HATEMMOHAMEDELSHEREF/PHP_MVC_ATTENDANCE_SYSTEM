<?php


namespace App\Controllers;


use App\Lib\Helper;
use App\Models\AuthenticationModel;

class AuthenticationController extends AbstractController
{



    public function view(){
        require_once $this->getView();
    }

    public function loginAction(){
        if (isset($_SERVER['REQUEST_METHOD'])){
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $user_email     =   $_POST['user_email'];
                $user_password  =   $_POST['user_password'];

                $user_email     =\App\Lib\Helper::FilterEmail($user_email);

                $user_password  =\App\Lib\Helper::Filter_String($user_password);

                $MODEL=new AuthenticationModel();
                $MODEL->instructor_email=$user_email;
                $MODEL->instructor_password=$user_password;
                $this->_DATA=$MODEL->LoginToSystem();
                if ($this->_DATA['Status']===true){
                    $_SESSION['user_auth']=$this->_DATA;
                    \App\Lib\Helper::Redirect('/index/default');
            }else{
                    $this->view();
            }

            }
        }
        $this->view();
    }
    public function forgetAction(){
        $this->view();
    }
    public function confirmAction(){
        $this->view();
    }
    public function resetAction(){
        $this->view();
    }
    public function logoutAction(){
        session_unset();
        session_destroy();
        Helper::Redirect('/authentication/login');
    }

}