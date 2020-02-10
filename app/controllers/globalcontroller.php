<?php


namespace App\Controllers;
use Exception;

class GlobalController extends AbstractController
{

    public function uploadAction(){
        if (isset($_POST['path'])) {
            try {

                $path = $_POST['path'];
                $name = 'QR/' . date('Y-m-d') . substr(md5(uniqid()), 0, 10) . '.png';
                if (copy($path, $name)) {
                    echo 'success';
                    $_SESSION['STUDENTQR'] = $name;
                } else {
                    echo 'failed';
                }
            } catch (Exception $e) {
                echo 'exception thrown';
            }
        }
    }

}