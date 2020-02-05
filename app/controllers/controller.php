<?php


namespace App\Controllers;


class Controller
{
    private $CONTROLLER;
    private $ACTION;
    private $PARAMS=[];
    private $TEMPLATE;

    public function defaultAction(){
       $this->view();
    }
    public function notfoundAction(){
        echo 'Not found Controller/Action';
    }

    public function view(){
        $view =VIEW_PATH.strtolower($this->CONTROLLER).DS.strtolower($this->ACTION).'.view.php';
        $this->TEMPLATE->setView($view);
        $this->TEMPLATE->RenderApp();
    }
    public function getView(){
        $view =VIEW_PATH.strtolower($this->CONTROLLER).DS.strtolower($this->ACTION).'.view.php';
        return $view;
    }

    public function setController($controller){
        $this->CONTROLLER=$controller;
    }
    public function setAction($action){
        $this->ACTION=$action;
    }
    public function setParams($params){
        $this->PARAMS=$params;
    }
    public function setTemplate($template){
        $this->TEMPLATE=$template;

    }

}