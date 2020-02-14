<?php
extract($this->Data);

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['index'])){
                echo '<div class="alert alert-'.$_SESSION['index']['Type'].' '.$_SESSION['index']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['index']['Msg'].'
                </div>';
                unset($_SESSION['index']);
            }
            ?>

            <div class="track-panel">
                <h3>Admin Controller</h3>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate action="/index/changerole" method="post">
                    <div class="form-group">
                        <label><span class="text-dark">Instructor</span></label>
                        <select class="form-control" name="instructor_id">
                            <option selected disabled>Select Instructor</option>
                            <?php
                            foreach ($instructors as $instructor):?>
                                <option value="<?=$instructor->instructor_id;?>"><?=$instructor->instructor_name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><span class="text-dark">Role</span></label>
                        <select class="form-control" name="instructor_role">
                            <option selected disabled>Select Role</option>
                            <option value="admin">admin</option>
                            <option value="general">general</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
