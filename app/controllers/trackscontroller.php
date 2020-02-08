<?php


namespace App\Controllers;


use App\Lib\Helper;
use App\Lib\Services;
use App\Models\TrackDaysModel;
use App\Models\TracksModel;

class TracksController extends AbstractController
{

    public function defaultAction()
    {
        $TRACK=new TracksModel();
        $RESULT=$TRACK->getAll();
        $this->_DATA['tracks']=$RESULT;
        $this->view();
    }
    public function addAction(){
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            $track_name = $_POST['track_name'];
            $track_cost = $_POST['track_cost'];
            if (empty($track_name)) {
                $Result = array(
                    'Msg' => 'Invalid Track Name',
                    'Type' => 'danger',
                    'Status' => false
                );
                $_SESSION['track'] = $Result;
                Helper::Redirect('/tracks/add');
            } else {
                $track_name = Helper::Filter_String($track_name);
                if ($track_name == null) {
                    $Result = array(
                        'Msg' => 'Invalid Track Name',
                        'Type' => 'danger',
                        'Status' => false
                    );
                    $_SESSION['track'] = $Result;
                    Helper::Redirect('/tracks/add');
                } else {
                    $track_cost = Helper::Filter_Float($track_cost);
                    if ($track_cost === false) {
                        $Result = array(
                            'Msg' => 'Invalid Track Cost Must Be Number',
                            'Type' => 'danger',
                            'Status' => false
                        );
                        $_SESSION['track'] = $Result;
                        Helper::Redirect('/tracks/add');
                    } else {
                        if (isset($_POST['track_instructor_id'])) {
                            $result = Services::getAll('att_instructors');
                            $instructors = [];
                            foreach ($result['Data'] as $item) {
                                array_push($instructors, $item->instructor_id);
                            }
                            if (in_array($_POST['track_instructor_id'], $instructors)) {
                                if (isset($_POST['track_place_id'])) {
                                    $result = Services::getAll('att_places');
                                    $places = [];
                                    foreach ($result['Data'] as $item) {
                                        array_push($places, $item->place_id);
                                    }
                                    if (in_array($_POST['track_place_id'], $places)) {
                                        if (isset($_POST['track_days'])) {
                                            $selected_days = $_POST['track_days'];
                                            $result = Services::getAll('att_week_days');
                                            $days = [];
                                            foreach ($result['Data'] as $item) {
                                                array_push($days, $item->day_id);
                                            }
                                            foreach ($selected_days as $day) {
                                                if (!in_array($day, $days)) {
                                                    $Result = array(
                                                        'Msg' => 'Invalid Selection Of Track Days',
                                                        'Type' => 'danger',
                                                        'Status' => false
                                                    );
                                                    $_SESSION['track'] = $Result;
                                                    Helper::Redirect('/tracks/add');
                                                }
                                            }
                                            $TRACK = new TracksModel();
                                            $TRACK->track_name = $track_name;
                                            $TRACK->track_cost = $track_cost;
                                            $TRACK->track_instructor_id = $_POST['track_instructor_id'];
                                            $TRACK->track_place_id = $_POST['track_place_id'];
                                            $Result = $TRACK->save();
                                            if ($Result['Status'] === true) {
                                                $_SESSION['track'] = $Result;
                                                $TRACK_DAY = new TrackDaysModel();
                                                $LASTID = $Result['ID'];
                                                foreach($_POST['track_days'] as $day_id){
                                                    $TRACK_DAY->track_id=$LASTID;
                                                    $TRACK_DAY->day_id=$day_id;
                                                    $Result=$TRACK_DAY->Save();
                                                    if($Result['Status']===true){
                                                        $_SESSION['track']=$Result;
                                                        Helper::Redirect('/tracks/add');
                                                    }else{
                                                        $_SESSION['track']=$Result;
                                                        Helper::Redirect('/tracks/add');
                                                    }
                                                }
                                            } else {
                                                $_SESSION['track'] = $Result;
                                                 Helper::Redirect('/tracks/add');
                                            }
                                        } else {
                                            $Result = array(
                                                'Msg' => 'You Must Select Track Days',
                                                'Type' => 'danger',
                                                'Status' => false
                                            );
                                            $_SESSION['track'] = $Result;
                                            Helper::Redirect('/tracks/add');
                                        }
                                    } else {
                                        $Result = array(
                                            'Msg' => 'Invalid Track Place',
                                            'Type' => 'danger',
                                            'Status' => false
                                        );
                                        $_SESSION['track'] = $Result;
                                        Helper::Redirect('/tracks/add');
                                    }
                                } else {
                                    $Result = array(
                                        'Msg' => 'You Must Select Track Place',
                                        'Type' => 'danger',
                                        'Status' => false
                                    );
                                    $_SESSION['track'] = $Result;
                                    Helper::Redirect('/tracks/add');
                                }
                            } else {
                                $Result = array(
                                    'Msg' => 'Invalid Track Instructor',
                                    'Type' => 'danger',
                                    'Status' => false
                                );
                                $_SESSION['track'] = $Result;
                                Helper::Redirect('/tracks/add');
                            }
                        } else {
                            $Result = array(
                                'Msg' => 'You Must Select Instructor ',
                                'Type' => 'danger',
                                'Status' => false
                            );
                            $_SESSION['track'] = $Result;
                            Helper::Redirect('/tracks/add');
                        }
                    }
                }
            }
        }

        else{
            $TRACK=new TracksModel();
            $result_days=Services::getAll('att_week_days');
            if ($result_days['Status']===true){
                $this->_DATA['days']=$result_days['Data'];
                $result_places=Services::getAll('att_places');
                if ($result_places['Status']===true){
                    $this->_DATA['places']=$result_places['Data'];
                    $result_instructors=Services::getAll('att_instructors');
                    if ($result_instructors['Status']===true){
                        $this->_DATA['instructors']=$result_instructors['Data'];
                        $this->view();
                    }else{
                        Helper::Redirect('/tracks/default');
                    }
                }else{
                    Helper::Redirect('/tracks/default');
                }
            }else{
                Helper::Redirect('/tracks/default');
            }
        }

    }
    public function editAction(){
        $this->view();
    }
    public function deleteAction(){

    }
    public function showallAction(){
        $this->setAction('default');
        $this->view();
    }
}