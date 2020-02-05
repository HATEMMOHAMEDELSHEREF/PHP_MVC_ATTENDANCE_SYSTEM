<?php


namespace App\Controllers;


class AuthenticationController extends Controller
{


    public function loginAction(){
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
    public function view(){
        require_once $this->getView();
    }
}