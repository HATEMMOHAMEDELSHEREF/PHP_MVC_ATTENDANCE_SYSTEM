<?php

namespace App\Lib;
use App\Lib\Helper;

class Brain
{

    private $_controller;

    private $_action;

    private $_params;

    private $_template;

    const NOTFOUNDCONTROLLER='App\Controllers\NotFoundController';

    const NOTFOUNDACION='notfoundAction';

    public function __construct(\App\Lib\Template $template)
    {
        $url=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (isset($_SESSION['user_auth'])) {
            $this->_controller = 'index';
            $this->_action = 'default';
            $this->_template=$template;
            $this->_parseUrl($url);
        }else{
            $this->_template=$template;
            $this->_parseUrl($url);
        }
       /* else {
            $this->_controller = 'authentication';
            $this->_action = 'login';
            $this->_parseUrl($url);
            if ($this->_controller!=='authentication'){

                Helper::Redirect('/authentication/login');
            }else{
                if (!in_array($this->_action,['login','reset','confirm','forget'])){
                    Helper::Redirect('/authentication/login');
                }
            }

            $this->_template=$template;
        }
       */

    }

    public function _parseUrl($url)
    {
        $url = trim($url, '/');
        $url_parts = explode('/', $url, 3);
        if (isset($url_parts[0]) and !empty($url_parts[0])){
            $this->_controller = $url_parts[0];
        }
        if (isset($url_parts[1]) and !empty($url_parts[1])){
            $this->_action = $url_parts[1];
        }
        if (isset($url_parts[2]) and !empty($url_parts[2])){
            $this->_params = explode('/', $url_parts[2]);
        }
    }

    public function _dispath()
    {
        $this->_controller=ucfirst($this->_controller);
        $CONTROLLERNAME=$this->_controller.'Controller';
        $CONTROLLERNAME='App\Controllers\\'.$CONTROLLERNAME;
        $ACTIONNAME=$this->_action;
        if (!class_exists($CONTROLLERNAME)){
            $CONTROLLERNAME=self::NOTFOUNDCONTROLLER;
            $this->_controller='NotFound';
            $this->_action='notfound';
            $ACTIONNAME=$this->_action;
        }else{
            if(!method_exists(new $CONTROLLERNAME,$ACTIONNAME.'Action')){
                $this->_action='notfound';
                $ACTIONNAME=$this->_action;
            }else{
                $ACTIONNAME=$this->_action;
            }
        }
        $object=new $CONTROLLERNAME;
        $object->setController($this->_controller);
        $object->setAction($this->_action);
        $object->setParams($this->_params);
        $object->setTemplate($this->_template);

        $ACTIONNAME=$ACTIONNAME.'Action';
        ($object)->$ACTIONNAME();

    }

}