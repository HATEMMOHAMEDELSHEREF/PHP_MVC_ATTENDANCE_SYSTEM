<?php
extract($this->Data);
extract($tracks);
extract($tracks_days);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['tracks'])){
                echo '<div class="alert alert-'.$_SESSION['tracks']['Type'].' '.$_SESSION['tracks']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['tracks']['Msg'].'
                </div>';
                unset($_SESSION['tracks']);
            }
            ?>
            <div class="track-panel">
                <h3>Edit Track</h3>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate action="/tracks/edit/<?=$tracks[0]->track_id;?>" method="post">
                    <div class="col-xs-6 tracks-left-side">
                        <div class="form-group">
                            <label><span class="text-dark">Track Name</span></label>
                            <input type="text"   name="track_name" class="form-control" placeholder="Track Name" value="<?=$tracks[0]->track_name;?>">
                            <input type="hidden" name="track_id" class="form-control" placeholder="Track Id" value="<?=$tracks[0]->track_id;?>">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor</span></label>
                            <select class="form-control" name="track_instructor_id">
                                <?php
                                foreach ($tracks_instructors as $instructor):?>
                                    <?php
                                if ($instructor->instructor_id==$tracks[0]->track_instructor_id):?>
                                    <option value="<?=$instructor->instructor_id;?>" selected><?=$instructor->instructor_name;?></option>
                                <?php continue; endif;?>
                                    <option value="<?=$instructor->instructor_id;?>"><?=$instructor->instructor_name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Cost</span></label>
                            <input type="text" class="form-control" name="track_cost" placeholder="Track Cost" value="<?=$tracks[0]->track_cost;?>">
                        </div>

                    </div>
                    <div class="col-xs-6 tracks-right-side">
                        <div class="form-group">
                            <label><span class="text-dark">Place</span></label>
                            <select class="form-control" name="track_place_id">
                                <?php
                                foreach ($tracks_places as $place):?>
                                    <?php
                                    if ($place->place_id==$tracks[0]->track_place_id):?>
                                        <option value="<?=$place->place_id;?>" selected><?=$place->place_name;?></option>
                                        <?php continue; endif;?>
                                    <option value="<?=$place->place_id;?>"><?=$place->place_name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <label><span class="text-dark">Days</label>
                        <div class="tracks-choice">
                            <div class="row">
                                <?php
                                foreach ($tracks_week_days as $day):?>
                                    <div class="track-item">
                                        <div class="funkyradio-danger">
                                            <div class="funkyradio-md">
                                                <?php
                                                $days_id=array_column($tracks_days,'day_id');
                                                ?>
                      <input <?php echo(in_array($day->day_id,$days_id))?'checked':''; ?> type="checkbox" name="track_days[]" id="radio-md-<?=$day->day_id;?>" value="<?=$day->day_id;?>">
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