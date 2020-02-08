<?php


namespace App\Controllers;


use App\Models\InstructorModel;
use App\Lib\Helper;
use App\Lib\Uploader;
use App\Models\Model;

class InstructorController extends AbstractController
    {
    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['instructor_avatar'])) {
                Uploader::$FILE = $_FILES['instructor_avatar'];
                if ((Uploader::CheckUserUploaded())===true) { /* user browsed his pc and selected item */
                    if ((Uploader::CheckSize())===false){
                        $Result=array(
                            'Msg'        =>'Failed To Upload As Image Size Exceeded The Limit',
                            'Type'       =>'danger',
                            'Status'     =>false
                        );
                        $_SESSION['instructor'] =$Result;
                        Helper::Redirect('/instructor/default');
                    }else{
                        $Result = Uploader::Upload();
                        if ($Result['Status'] === false) {
                            $_SESSION['instructor'] = $Result;
                            Helper::Redirect('/instructor/default');
                        } else {
                            $_SESSION['instructor'] = $Result;
                            $_SESSION['uploaded_image'] = Uploader::$Destination;
                        }
                    }
                }

            }
            $MODEL = new InstructorModel();
            $MODEL->instructor_avatar = Uploader::$Destination;
            $email =     Helper::FilterEmail($_POST['instructor_email']);
            $name =      Helper::Filter_String($_POST['instructor_name']);
            $password =  Helper::Filter_String($_POST['instructor_password']);
            $phone =     Helper::FilterPhone($_POST['instructor_phone']);
            if ($phone === false or $email === false) {
                $Result = array(
                    'Msg' => 'Invalid Values',
                    'Type' => 'danger',
                    'Status' => false
                );
                $_SESSION['instructor'] = $Result;
                if (isset($_SESSION['uploaded_image'])){
                    Uploader::RemoveOld($_SESSION['uploaded_image']);
                    unset($_SESSION['uploaded_image']);
                }
                Helper::Redirect('/instructor/default');

            } else {
                $MODEL->instructor_name = $name;
                $MODEL->instructor_email = $email;
                $MODEL->instructor_phone = $phone;
                $MODEL->instructor_password = $password;
                $FinalResult=$MODEL->Save();
                if ($FinalResult['Status'] === true) {
                    $_SESSION['instructor'] =$FinalResult;
                    Helper::Redirect('/instructor/default');
                } else {
                    if (isset($_SESSION['uploaded_image'])){
                        Uploader::RemoveOld($_SESSION['uploaded_image']);
                        unset($_SESSION['uploaded_image']);
                    }
                }
                $_SESSION['instructor'] =$FinalResult;
                Helper::Redirect('/instructor/default');
            }
        }
        $this->view();
    }
    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] =='POST'){
            $MODEL = new InstructorModel();
            $MODEL->instructor_id = $_POST['instructor_id'];
            $MODEL->instructor_avatar = $_POST['instructor_Avatar'];
            if (isset($_FILES['instructor_avatar'])){
                Uploader::$FILE=$_FILES['instructor_avatar'];
                if (Uploader::CheckUserUploaded()===true){
                    if (Uploader::CheckSize()===true){
                        $Result=Uploader::Upload();
                        if ($Result['Status']===true){
                            $_SESSION['edit_instructor'] = $Result;
                            $_SESSION['uploaded_image']=$MODEL->instructor_avatar;
                            $_SESSION['new_uploaded_image']=Uploader::$Destination;
                            $MODEL->instructor_avatar=Uploader::$Destination;
                        }else{
                            $_SESSION['edit_instructor'] = $Result;
                            Helper::Redirect('/instructor/edit/'.$MODEL->instructor_id);
                        }
                        }else{
                        $Result=array(
                            'Msg'        =>'Failed To Upload As Image Size Exceeded The Limit',
                            'Type'       =>'danger',
                            'Status'     =>false
                        );
                        $_SESSION['edit_instructor']=$Result;
                        Helper::Redirect('/instructor/edit/'.$MODEL->instructor_id);
                    }
                }
            }
                        $email =    Helper::FilterEmail($_POST['instructor_email']);
                        $name =     Helper::Filter_String($_POST['instructor_name']);
                        $password = Helper::Filter_String($_POST['instructor_password']);
                        $phone =    Helper::FilterPhone($_POST['instructor_phone']);
                        if ($phone === false or $email === false) {
                            $this->_DATA['instructor'] = array(
                                'Msg' => 'Invalid Values',
                                'Type' => 'danger',
                                'Status' => false
                            );
                            if (isset($_SESSION['new_uploaded_image'])){
                                if (file_exists($_SESSION['new_uploaded_image'])){
                                    Uploader::RemoveOld($_SESSION['new_uploaded_image']);
                                    unset($_SESSION['new_uploaded_image']);
                                    unset($_SESSION['uploaded_image']);
                                }
                            }
                            $_SESSION['edit_instructor'] = $this->_DATA['instructor'];
                            Helper::Redirect('/instructor/edit/' .$MODEL->instructor_id);
                        } else {
                            $MODEL->instructor_name = $name;
                            $MODEL->instructor_email = $email;
                            $MODEL->instructor_phone = $phone;
                            $MODEL->instructor_password = $password;
                            $FinalResult = $MODEL->Save();
                            if ($FinalResult['Status'] === true) {
                                $this->_DATA['instructor'] = $FinalResult;
                                if (isset($_SESSION['uploaded_image'])){
                                    if (file_exists($_SESSION['uploaded_image'])){
                                        Uploader::RemoveOld($_SESSION['uploaded_image']);
                                        unset($_SESSION['uploaded_image']);
                                        unset($_SESSION['new_uploaded_image']);
                                    }
                                }
                            } else {
                               if (isset($_SESSION['new_uploaded_image'])){
                                   if (file_exists($_SESSION['new_uploaded_image'])){
                                       Uploader::RemoveOld($_SESSION['new_uploaded_image']);
                                       unset($_SESSION['new_uploaded_image']);
                                       unset($_SESSION['uploaded_image']);
                                   }
                               }
                                $this->_DATA['instructor'] = $FinalResult;
                            }
                        }
                        $_SESSION['edit_instructor'] = $this->_DATA['instructor'];
                        Helper::Redirect('/instructor/edit/'.$MODEL->instructor_id);

        }else {
            $MODEL = new InstructorModel();
            if (isset($this->PARAMS[0])) {
                $PK = Helper::Filter_Int($this->PARAMS[0]);
                if ($PK !== false) {
                    $result = $MODEL->getByPk($PK);
                    if ($result['Status'] === true) {
                        $this->_DATA['instructor'] = $result['Data'];
                    } else {
                        Helper::Redirect('/instructor/default');
                    }
                }else{
                    Helper::Redirect('/instructor/default');
                }
            }else{
                Helper::Redirect('/instructor/default');
            }
             $this->view();
        }
    }
    public function defaultAction()
    {
        $MODEL = new InstructorModel();
        $this->_DATA['instructor'] = $MODEL->getAll();
        $this->view();
    }
    public function showallAction(){
        $this->setAction('default');
        $this->defaultAction();
    }
    public function deleteAction(){
        $PK=NULL;
        if (isset($this->PARAMS[0]) and !empty($this->PARAMS[0])){
            $PK=$this->PARAMS[0];
            if (Helper::Filter_Int($PK)!==false){
                    $PK=Helper::Filter_Int($PK);
                    $MODEL=new InstructorModel();
                    $Result=$MODEL->getByPk($PK);
                    $avatar=$Result['Data'][0]->instructor_avatar;
                    if ($Result['Status']===true){
                        $Result=$MODEL->Remove($PK);
                        if ($Result['Status']===true){
                            Uploader::RemoveOld($avatar);
                        }
                        $_SESSION['delete_instructor']=$Result;
                        Helper::Redirect('/instructor/default');
                    }else{
                        $_SESSION['delete_instructor']=$Result;
                        Helper::Redirect('/instructor/default');
                    }
            }else{
                Helper::Redirect('/instructor/default');
            }
        }else{
            Helper::Redirect('/instructor/default');
        }
    }
    }