<?php

extract($this->Data);
extract($tracks);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="track-panel">
                <h3>Tracks <span class="badge-primary"><?=count($tracks);?></span></h3>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive ">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Track</td>
                        <td>Instructor</td>
                        <td>Cost</td>
                        <td>Place</td>
                        <td>Days</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($tracks as $track):?>
                        <tr>
                            <td><?=$track->track_id;?></td>
                            <td><?=$track->track_name;?></td>
                            <td><?=$track->instructor_name;?></td>
                            <td><?=$track->track_cost;?></td>
                            <td><?=$track->place_name;?></td>
                            <?php
                            $output="";
                            foreach ($tracks_days as $days){
                                if ($days->track_id==$track->track_id){
                                    $output.=$days->day_name."@";
                                }
                            }
                            ?>
                            <td><?=trim($output,"@");?></td>
                            <td>
                                <a href="#"><i class="fa fa-edit"></i></a>
                                <a href="#"><i class="fa fa-trash"></i></a>
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