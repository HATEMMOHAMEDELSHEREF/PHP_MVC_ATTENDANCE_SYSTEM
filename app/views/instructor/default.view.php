<?php

extract($this->Data);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['delete_instructor'])){
                $_SESSION['instructor']=$_SESSION['delete_instructor'];
            }
            if (isset($_SESSION['instructor'])){
                echo '<div class="alert alert-'.$_SESSION['instructor']['Type'].' '.$_SESSION['instructor']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['instructor']['Msg'].'
                </div>';
                unset($_SESSION['delete_instructor']);
                unset($_SESSION['instructor']);
            }
            ?>
        </div>
        <div class="col-xs-12 mr-bottom">
            <div class="track-panel">
                <h3 class="pull-left">Instructors <span class="badge-primary"><?= count($instructor)?></span></h3>
                <a class="btn btn-primary pull-right" href="/instructor/add"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="clearfix mr-bottom"></div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive ">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Instructor</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($instructor as $element):?>
                        <tr>
                            <td><?=$element->instructor_id;?></td>
                            <td><?=$element->instructor_name;?></td>
                            <td><?=$element->instructor_email;?></td>
                            <td><?=$element->instructor_phone;?></td>
                            <td>
                                <a href="/instructor/edit/<?=$element->instructor_id;?>"><i class="fa fa-edit"></i></a>
                                <a href="/instructor/delete/<?=$element->instructor_id;?>" onclick="return (confirm('Do You Sure To Remove This Instructor'))?true:false;">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->

