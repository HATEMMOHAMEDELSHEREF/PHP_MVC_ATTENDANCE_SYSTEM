
<?php
extract($this->Data);

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['edit_instructor'])){
                echo '<div class="alert alert-'.$_SESSION['edit_instructor']['Type'].' '.$_SESSION['edit_instructor']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['edit_instructor']['Msg'].'
                </div>';
                unset($_SESSION['edit_instructor']);
            }
            ?>
            <div class="track-panel">
                <h3>Edit Instructors </h3>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate method="post" action="/instructor/edit/<?=$instructor[0]->instructor_id;?>" enctype="multipart/form-data">
                    <div class="col-xs-6 tracks-left-side">
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Name</span></label>
                            <input type="text" name="instructor_name" class="form-control"  placeholder="Instructor Name" value="<?=$instructor[0]->instructor_name;?>">
                            <input type="hidden" name="instructor_id" class="form-control"  placeholder="Instructor Id" value="<?=$instructor[0]->instructor_id;?>">
                            <input type="hidden" name="instructor_Avatar" class="form-control"  placeholder="Instructor Avatar" value="<?=$instructor[0]->instructor_avatar;?>">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Email</span></label>
                            <input type="text" name="instructor_email" class="form-control"  placeholder="Instructor Email" value="<?=$instructor[0]->instructor_email;?>">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Phone</span></label>
                            <input type="text" name="instructor_phone" class="form-control"  placeholder="Instructor Phone" value="<?=$instructor[0]->instructor_phone;?>">
                        </div>

                    </div>
                    <div class="col-xs-6 tracks-right-side">
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Avatar</span></label>
                            <input type="file" class="form-control" name="instructor_avatar"  placeholder="Instructor Avatar">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Password</span></label>
                            <input type="password" name="instructor_password" class="form-control"  placeholder="Instructor Password" value="<?=$instructor[0]->instructor_password;?>">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Save</span></label>
                            <br>
                            <button type="submit" class="btn btn-primary  ">Save</button>
                            <a href="/instructor/default" type="submit" class="btn btn-danger ">Cancel</a>
                        </div>
                    </div>


                </form>
            </div>

        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->

