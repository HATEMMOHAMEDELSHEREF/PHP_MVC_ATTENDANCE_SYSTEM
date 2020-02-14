<?php


namespace App\Controllers;

use App\Lib\Helper;
use App\Lib\Services;
use App\Models\IndexModel;

class IndexController extends AbstractController
{


    public function defaultAction()
    {
       $students=Services::getAll('att_students','count(*) as total ')['Data'][0]->total;
       $instructors=Services::getAll('att_instructors','count(*) as total ')['Data'][0]->total;
       $tracks=Services::getAll('att_tracks','count(*) as total ')['Data'][0]->total;
       $qr=Services::getAll('att_students','count(*) as total ')['Data'][0]->total;
       $places=Services::getAll('att_places','count(*) as total ')['Data'][0]->total;
       $admins=Services::getAll('att_instructors','count(*) as total ',' WHERE instructor_role=\'admin\'')['Data'][0]->total;

       $this->_DATA['students']=$students;
       $this->_DATA['qr']=$qr;
       $this->_DATA['instructors']=$instructors;
       $this->_DATA['tracks']=$tracks;
       $this->_DATA['places']=$places;
       $this->_DATA['admins']=$admins;
       $this->view();
    }

    public function adminAction(){
        $instructors=Services::getAll('att_instructors','*')['Data'];
        $this->_DATA['instructors']=$instructors;
        $this->view();
    }

    public function  changeroleAction(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $roles=['general','admin'];
            $instructor_id=Helper::Filter_Int($_POST['instructor_id']);
            if ($instructor_id!=false){
                $instructor_role=$_POST['instructor_role'];
                $INDEX=new IndexModel();
                    if (in_array($instructor_role,$roles)){
                        $INDEX=IndexModel::updateRole($instructor_id,$instructor_role);
                        $_SESSION['index']=$INDEX;
                        Helper::Redirect('/index/admin');
                    }else{
                        // invalid role
                        $result=array(
                            'Msg'=>'Invalid Role',
                            'Type'=>'danger',
                            'Status'=>false
                        );
                        $_SESSION['index']=$result;
                        Helper::Redirect('/index/admin');
                    }
            }else{
                // invalid id
                $result=array(
                    'Msg'=>'Invalid Id',
                    'Type'=>'danger',
                    'Status'=>false
                );
                $_SESSION['index']=$result;
                Helper::Redirect('/index/admin');
            }

        }
    }


}