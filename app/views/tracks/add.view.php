<?php
extract($this->Data);

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['track'])){
                echo '<div class="alert alert-'.$_SESSION['track']['Type'].' '.$_SESSION['track']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['track']['Msg'].'
                </div>';
                unset($_SESSION['track']);
            }
            ?>
            <div class="track-panel">
                <h3>Add Tracks</h3>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate method="post" action="/tracks/add">
                    <div class="col-xs-6 tracks-left-side">
                        <div class="form-group">
                            <label><span class="text-dark">Track Name</span></label>
                            <input type="text" name="track_name" class="form-control"  placeholder="Track Name">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor</span></label>
                            <select class="form-control" name="track_instructor_id">
                                <option selected disabled>Select Instructor</option>
                                <?php
                                foreach ($instructors as $instructor):?>
                                    <option value="<?=$instructor->instructor_id;?>"><?=$instructor->instructor_name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Cost</span></label>
                            <input type="text" name="track_cost" class="form-control"  placeholder="Track Cost">
                        </div>

                    </div>
                    <div class="col-xs-6 tracks-right-side">
                        <div class="form-group">
                            <label><span class="text-dark">Place</span></label>
                            <select class="form-control" name="track_place_id">
                                <option selected disabled>Select Place</option>
                                <?php
                                foreach ($places as $place):?>
                                    <option value="<?=$place->place_id;?>"><?=$place->place_name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <label><span class="text-dark">Days</label>
                        <div class="tracks-choice">
                            <div class="row">
                                <?php
                                foreach ($days as $day):?>
                                    <div class="track-item">
                                        <div class="funkyradio-danger">
                                            <div class="funkyradio-md">
                                                <input type="checkbox" name="track_days[]" id="radio-md-<?=$day->day_id;?>" value="<?=$day->day_id;?>">
                                                <label for="radio-md-<?=$day->day_id;?>"><?=$day->day_name;?></label>
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