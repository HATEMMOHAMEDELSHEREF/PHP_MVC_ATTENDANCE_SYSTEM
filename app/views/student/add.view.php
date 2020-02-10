
<?php


extract($this->Data)
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
                    <h3>Add New Students</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">


                <form autocomplete="off" novalidate method="post" action="/student/add">
                    <div class="col-xs-6 tracks-left-side">
                        <div class="form-group">
                            <label><span class="text-dark">Student Name</span></label>
                            <input type="text" name="student_name" class="form-control"  placeholder="Student Name">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Student Email</span></label>
                            <input type="text" name="student_email" class="form-control"  placeholder="Student Email">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Student Phone</span></label>
                            <input type="text" name="student_phone" class="form-control"  placeholder="Student Phone">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Student Level</span></label>
                            <select class="form-control" name="student_level">
                                <option selected disabled>Select Level</option>
                                <?php
                                $Levels=array(1,2,3,4,'other');
                                foreach($Levels as $level):?>
                                    <option value="<?=$level;?>"><?=$level;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>


                    </div>
                    <div class="col-xs-6 tracks-right-side">


                        <label><span class="text-dark">Tracks</label>
                        <div class="tracks-choice">
                            <div class="row">
                                <?php
                                foreach ($tracks as $track):?>
                                    <div class="track-item track-item-student">
                                        <div class="funkyradio-danger">
                                            <div class="funkyradio-md">
                                                <input type="checkbox" name="student_track[]" id="radio-md-<?=$track->track_id;?>" value="<?=$track->track_id;?>">
                                                <label for="radio-md-<?=$track->track_id;?>"><?=$track->track_name;?></label>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Save</button>
                        </div>
                    </div>


                </form>

            </div>


        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->
