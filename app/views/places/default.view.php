<?php

extract($this->Data);
?>
<div class="container">
    <div class="row">

        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['place'])){
                echo '<div class="alert alert-'.$_SESSION['place']['Type'].' '.$_SESSION['place']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['place']['Msg'].'
                </div>';
                unset($_SESSION['place']);
            }
            ?>
            <div class="track-panel">
                <h3>Places <span class="badge-primary"><?=count($place);?></span></h3>
                <a class="btn btn-primary pull-right" href="/places/add"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
            <div class="col-xs-12 trackss">
                <table class="table table-striped table-responsive ">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Place Name</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($place as $item):?>
                        <tr>
                            <td><?= $item->place_id;?></td>
                            <td><?= $item->place_name;?></td>
                            <td>
                                <a href="/places/edit/<?= $item->place_id;?>"><i class="fa fa-edit"></i></a>
                                <a href="/places/delete/<?= $item->place_id;?>" onclick="return confirm('Do You Sure To Remove This Element')?true:false"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>