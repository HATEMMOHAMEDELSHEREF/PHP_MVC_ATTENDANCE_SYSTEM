<?php

extract($this->Data);
extract($session);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php

            if (isset($_SESSION['session'])){
                echo '<div class="alert alert-'.$_SESSION['session']['Type'].' '.$_SESSION['session']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['session']['Msg'].'
                </div>';
                unset($_SESSION['session']);
            }
            ?>
        </div>

        <span class="clearfix"></span>
        <div class="col-xs-6">

            <form autocomplete="off" novalidate method="post" action="/sessions/edit/<?=$session[2][0]->session_id;?>">
                <div class="col-xs-12">
                    <h3>Edit Session</h3>
                </div>
                <div class="form-group">
                    <label for="InstructorName">Instructor Name</label>
                    <input type="text" class="form-control"  value="<?=$session[1]?>" disabled>
                    <input type="hidden" class="form-control" name="session_id"  value="<?=$session[2][0]->session_id;?>">
                </div>
                <div class="form-group">
                    <label for="trackname">Track Name</label>
                    <select class="form-control" name="session_track_id">
                        <?php
                        foreach ($session[0] as $track):?>
                        <option value="<?=$track->track_id;?>"><?=$track->track_name;?></php></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" class="form-control"  value="<?=$session[2][0]->session_date;?>" disabled>
                </div>
                <div class="form-group">
                    <label for="sessionname">Session Name</label>
                    <input type="text" class="form-control" name="session_name" value="<?=$session[2][0]->session_name;?>"  placeholder="Enter Session Name">
                </div>
                <div class="form-group">
                    <button type="submit" class=" btn btn-success">Edit Session</button>
                </div>

            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->