<?php

extract($this->Data);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 student-heading">
            <?php
            if (isset($_SESSION['student'])){
                echo '<div class="alert alert-'.$_SESSION['student']['Type'].' '.$_SESSION['student']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['student']['Msg'].'
                </div>';
                unset($_SESSION['student']);
            }
            ?>
            <div class="col-xs-4 title-zone">
                <div class="track-panel">
                    <h3>Students <span class="badge-primary"><?=count($student)?></span></h3>
                </div>
            </div>
            <div class="col-xs-8 qr-zone">
                <h3>
                    <canvas  id="qr"></canvas>
                </h3>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 trackss">

            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive " id="student-table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Student</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Track</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($student as $stud):?>
                        <tr>
                            <td><?=$stud->student_id;?></td>
                            <td><?=$stud->student_name;?></td>
                            <td><?=$stud->student_email;?></td>
                            <td><?=$stud->student_phone;?></td>
                        <?php
                        $STUDENTTRACKS=new \App\Models\StudentTracksModel();
                        $result=$STUDENTTRACKS->getAllStudentTrack($stud->student_id)['Data'];
                       // var_dump($result);
                        $output="";
                        ?>
                            <?php foreach ($result as $tracks){
                            $output.=$tracks->track_name."@";
                            }
                            ?>
                            <td><?=trim($output,'@');?></td>
                            <td>
                                <a title="edit student info" href="/student/edit/<?=$stud->student_id?>"><i class="fa fa-edit"></i></a>
                                <a title="delete student" href="/student/delete/<?=$stud->student_id?>"
                                 onclick="return (confirm('Do You Sure To Remove This Student'))?true:false"
                                ><i class="fa fa-trash"></i></a>
                                <a title="show student qr"href="#" data-value="<?=$stud->student_qr?>" class="show-qr-btn"><i class="fa fa-qrcode"></i></a>
                                <a title="manage student paids" href="/money/default/<?=$stud->student_id?>"><i class="fa fa-money"></i></a>
                                <a title="send student qr" href="#" class="send-mail"
                                   data-value="<?=$stud->student_email.'#'.$stud->student_name.'#'.$stud->student_qr?>">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- /#page-content-wrapper -->

<div class="modal fade" id="modal-of-show-qr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Student Qr</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body text-center">
                <img id="qr-image" src="">
            </img>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
