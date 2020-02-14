<?php


namespace App\Controllers;


use App\Lib\Helper;
use App\Lib\Mailer;
use App\Models\AuthenticationModel;
use http\Header;

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
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            if (isset($_POST['user_email']) and !empty($_POST['user_email'])){
                $user_email=Helper::FilterEmail($_POST['user_email']);
                $_SESSION['__TEMP__EMAIL__']=$user_email;
                if ($user_email===false){
                    $_SESSION['forget-msg']="Invalid Email Address";
                    Helper::Redirect('/authentication/forget');
                }else{
                    $random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                    $_SESSION['__CONFIRMATION__CODE__']=$random_number;
                    Mailer::SendMail(false,$user_email,'Confirmation Code','</b>'.$random_number.'</b>');
                    Helper::Redirect('/authentication/confirm');
                }
            }else{
                $_SESSION['forget-msg']="Invalid Email Address";
                Helper::Redirect('/authentication/forget');
            }
        }else{
            $this->view();
        }
    }
    public function confirmAction(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $_SESSION['__MY__CONFIRMED__CODE__']=$_POST['confirmed_code'];
            Helper::Redirect("/authentication/reset");
        }else{
            $this->view();
        }
    }
    public function resetAction(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            if (isset($_POST['new_password']) and !empty($_POST['new_password'])){
                $password=Helper::Filter_String($_POST['new_password']);
                if ($password==null){
                    $_SESSION['reset-msg']="Invalid Password";
                    Helper::Redirect('/authentication/reset');
                }else{
                    $Auth=new AuthenticationModel();
                    $result=$Auth->ResetPassword($password,$_SESSION['__TEMP__EMAIL__']);
                    if ($result==true){
                        Helper::Redirect('/authentication/login');
                    }else{
                        $_SESSION['reset-msg']="Invalid Operation";
                        Helper::Redirect('/authentication/reset');
                    }
                }
            }
        }else{
            $this->view();
        }
    }
    public function logoutAction(){
        session_unset();
        session_destroy();
        Helper::Redirect('/authentication/login');
    }

}