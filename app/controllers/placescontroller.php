<?php


namespace App\Controllers;


use App\Lib\Helper;
use App\Models\PlacesModel;
use http\Header;

class PlacesController extends AbstractController
{
    public function defaultAction()
    {
        $PLACE=new PlacesModel();
        $RESULT=$PLACE->getAll();
        $this->_DATA['place']=$RESULT;
        $this->view();
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD']=="POST"){

            $PLACE=new PlacesModel();
            $place_name=Helper::Filter_String($_POST['place_name']);
            if ($place_name===null){
                $Result = array(
                    'Msg' => 'Invalid Values',
                    'Type' => 'danger',
                    'Status' => false
                );
                $_SESSION['place'] = $Result;
                Helper::Redirect('/places/add');
            }else{
                $PLACE->place_name=$place_name;
                $RESULT=$PLACE->Save();
                if ($RESULT['Status']===true){
                    $_SESSION['place']=$RESULT;
                    Helper::Redirect('/places/add');
                }else{
                    $_SESSION['place']=$RESULT;
                    Helper::Redirect('/places/add');
                }
            }
        }else{
            $this->view();
        }
    }

    public function editAction(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $PLACE=new PlacesModel();
            $PLACE->place_id=$_POST['place_id'];
            $placename=Helper::Filter_String($_POST['place_name']);
            if ($placename===null){
                $Result = array(
                    'Msg' => 'Invalid Place Id',
                    'Type' => 'danger',
                    'Status' => false
                );
                $_SESSION['place'] = $Result;
                Helper::Redirect("/places/default");
            }else{
                $PLACE->place_name=$placename;
                $RESULT=$PLACE->Save();
                if ($RESULT['Status']===true){
                    $_SESSION['place']=$RESULT;
                    Helper::Redirect('/places/edit/'.$PLACE->place_id);
                }else{
                    $_SESSION['place']=$RESULT;
                    Helper::Redirect('/places/edit/'.$PLACE->place_id);
                }
            }

        }else{
            if (isset($this->PARAMS[0])){
                $PK=$this->PARAMS[0];
                if (!empty($PK)){
                    if (Helper::Filter_Int($PK)===null){
                        $Result = array(
                            'Msg' => 'Invalid Place Id',
                            'Type' => 'danger',
                            'Status' => false
                        );
                        $_SESSION['place'] = $Result;
                        Helper::Redirect("/places/default");
                    }else{
                        $PLACE=new PlacesModel();
                        $RESULT=$PLACE->getByPk($PK);
                        if ($RESULT['Status']===true){
                            $this->_DATA['place']=$RESULT['Data'];
                            $this->view();
                        }else{
                            $_SESSION['place'] = $RESULT;
                            Helper::Redirect("/places/default");
                        }
                    }
                }else{
                    $Result = array(
                        'Msg' => 'No Place Selected',
                        'Type' => 'danger',
                        'Status' => false
                    );
                    $_SESSION['place'] = $Result;
                    Helper::Redirect("/places/default");
                }
            }else{
                $Result = array(
                    'Msg' => 'No Place Selected',
                    'Type' => 'danger',
                    'Status' => false
                );
                $_SESSION['place'] = $Result;
                Helper::Redirect("/places/default");
            }

        }

    }

    public function showallAction(){
        $this->setAction('default');
        $this->view();
    }

    public function deleteAction(){
        if (isset($this->PARAMS[0])){
            $PK=$this->PARAMS[0];
            if (!empty($PK)){
                if (Helper::Filter_Int($PK)!==NULL){
                    $PLACE=new PlacesModel();
                    $RESULT=$PLACE->getByPk($PK);
                    if ($RESULT['Status']===true){
                        $RESULT=$PLACE->Remove($PK);
                        $_SESSION['place'] = $RESULT;
                        Helper::Redirect('/places/default');
                    }else{
                        $Result = array(
                            'Msg' => 'Invalid Place Id',
                            'Type' => 'danger',
                            'Status' => false
                        );
                        $_SESSION['place'] = $Result;
                        Helper::Redirect('/places/default');
                    }
                }else{
                    $Result = array(
                        'Msg' => 'Invalid Place Id',
                        'Type' => 'danger',
                        'Status' => false
                    );
                    $_SESSION['place'] = $Result;
                    Helper::Redirect('/places/default');
                }
            }else{
                $Result = array(
                    'Msg' => 'No Place Selected',
                    'Type' => 'danger',
                    'Status' => false
                );
                $_SESSION['place'] = $Result;
                Helper::Redirect('/places/default');
            }
        }else{
            $Result = array(
                'Msg' => 'Invalid Place Id',
                'Type' => 'danger',
                'Status' => false
            );
            $_SESSION['place'] = $Result;
            Helper::Redirect('/places/default');
        }
    }
}